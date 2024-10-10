<?php

namespace App\Helpers;

use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SoftwareUpdater
{
    const BETA_CHANNEL = 'beta';
    const STABLE_CHANNEL = 'stable';

    const CHANNEL_FILE = '.channel';
    const VERSION_FILE = '.version';

    const GITHUB_API_URL = 'https://api.github.com/repos/andreamarelli/imet_offline';

    /**
     * Get current release version (from VERSION_FILE)
     */
    public static function getCurrentVersion(): ?string
    {
        if(is_dev_environment()) return 'DEV';

        $filePath = base_path(self::VERSION_FILE);
        return file_exists($filePath)
            ? file_get_contents($filePath)
            : null;
    }

    /**
     * Get current release channel (from CHANNEL_FILE)
     */
    public static function getCurrentChannel(): string
    {
        $filePath = base_path(self::CHANNEL_FILE);
        if(!file_exists($filePath)){
            file_put_contents($filePath, self::STABLE_CHANNEL);
        }
        return file_get_contents($filePath);
    }

    /**
     * Set release channel
     */
    public static function setCurrentChannel($channel): void
    {
        $filePath = base_path(self::CHANNEL_FILE);
        if(file_exists($filePath)){
            unlink($filePath);
        }
        file_put_contents($filePath, $channel);
    }

    /**
     * Check if current channel is beta
     */
    public static function isBetaChannel(): bool
    {
        return static::getCurrentChannel() === self::BETA_CHANNEL;
    }

    /**
     * Check if a new version is available
     */
    public static function isNewVersionAvailable($forceApi = false): bool
    {
        if(is_dev_environment()) return false;

        // Retrieve current and latest version
        $currentVersion = static::getCurrentVersion();
        $latestVersion = static::getLatestReleases($forceApi)[0] ?? null;

        // Compare versions
        if (version_compare($latestVersion['tag_name'], $currentVersion) === 1) {
            return true;
        }
        return false;
    }

    /**
     * Get latest releases
     */
    public static function getLatestReleases($forceApi = false): array
    {
        // Get releases from GitHub API
        $releases = static::retrieveReleasesFromGithub($forceApi);

        return collect($releases)

            // Keep or discard beta releases (according to current release channel)
            ->filter(function($item){
                $item = (array) $item;
                $includeBeta = static::isBetaChannel();
                return !static::isBetaRelease($item)
                    || ($includeBeta && static::isBetaRelease($item));
            })

            // Ensure releases are sorted by version
            ->sortByDesc('tag_name', SORT_NATURAL|SORT_FLAG_CASE)
            ->map(function($item){
                $item = (array) $item;

                // Check if release requires re-installation
                $item = static::requiresInstallation($item);

                // Keep only needed fields
                return collect($item)
                    ->only(['tag_name', 'zipball_url', 'body', 'published_at', 'installer_url', 'require_installation'])
                    ->toArray();
            })

            ->values()
            ->toArray();
    }

    /**
     * Retrieve releases from GitHub API
     */
    private static function retrieveReleasesFromGithub($forceApi = false): array
    {
        $cacheFile = date("Y-m-d"). '_github_releases.json';

        // Retrieve from API
        if($forceApi || !Storage::disk(File::TEMP_STORAGE)->exists($cacheFile)){
            $apiResult = Http::get(self::GITHUB_API_URL . '/releases')->json();
            Storage::disk(File::TEMP_STORAGE)->put($cacheFile, json_encode($apiResult));
            Log::info('New releases retrieved from GitHub API.');
        }

        // Retrieve from cache (same day)
        else {
            $apiResult = json_decode(Storage::disk(File::TEMP_STORAGE)->get($cacheFile));
            Log::info('New releases loaded from cache (GitHub API).');
        }

        return $apiResult;
    }

    /**
     * Check if a release is a beta version
     */
    private static function isBetaRelease($release): bool
    {
        $tag = Str::lower($release['tag_name']);
        return $release['prerelease']
            || Str::contains($tag, 'beta')
            || Str::contains($tag, 'b')
            || Str::contains($tag, 'alpha')
            || Str::contains($tag, 'a');
    }

    /**
     * Check if a release requires re-installation
     */
    private static function requiresInstallation(array $release): array
    {
        $release['require_installation'] = false;
        $release['installer_url'] = null;

        // Check if assets are available
        if(array_key_exists('assets', $release) && count($release['assets'])>0){
            foreach ($release['assets'] as $asset){
                $asset = (array) $asset;
                // Check if asset is an installer
                if(Str::contains($asset['name'], 'setup', true)
                    && Str::contains($asset['name'], 'exe', true)){
                    $release['installer_url'] = $asset['browser_download_url'];
                    $release['require_installation'] = true;
                }
            }
        }
        return $release;
    }


}
