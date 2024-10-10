<?php

namespace App\Http\Controllers;

use App\Helpers\SoftwareUpdater;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UpdateController extends Controller
{
    public function index(Request $request)
    {
        $forceApi = $request->input('force_api', false);

        $release = SoftwareUpdater::getLatestReleases($forceApi)[0];
        $release_notes = nl2br($release['body']);
        $release_date = Carbon::parse($release['published_at'])->format('Y-m-d');

        $require_installation = $release['require_installation'] ?? false;
        $installer_url = $release['installer_url'] ?? null;

        return view('offline.update.index', [
            'latest_version' => $release['tag_name'],
            'current_version' => SoftwareUpdater::getCurrentVersion(),
            'release_notes' => $release_notes,
            'release_date' => $release_date,
            'download_url' => $release['zipball_url'],
            'require_installation' => $require_installation,
            'installer_url' => $installer_url
        ]);
    }

    public function update(Request $request)
    {
        $download_url = $request->input('download_url');
        $version = $request->input('version');

        $zip_path = storage_path('releases/IMET-' . $version . '.zip');

        // Download the zip file
        try{
            (new Client())->get($download_url, [RequestOptions::SINK => $zip_path]);
            Log::info('Download version ' . $version . ' completed. ('. $download_url. ')');
            return response()->json([
                'status' => 'success',
                'message' => 'Download successful',
                'path' => $zip_path
            ]);
        } catch (GuzzleException $e) {
            Log::error('Download version ' . $version . ' failed. ('. $download_url. ')');
            return response()->json([
                'status' => 'error',
                'message' => 'Download failed',
            ]);
        }
    }

    public function done()
    {
        return view('offline.update.done');
    }

    /**
     * Switch to stable channel
     */
    public function switch_to_beta(): RedirectResponse
    {
        SoftwareUpdater::setCurrentChannel(SoftwareUpdater::BETA_CHANNEL);

        return redirect()->route('update');
    }

    /**
     * Switch to stable channel
     */
    public function switch_to_stable(): View|RedirectResponse
    {
        $current_version = SoftwareUpdater::getCurrentVersion();
        $current_channel = SoftwareUpdater::getCurrentChannel();

        if($current_channel === SoftwareUpdater::STABLE_CHANNEL){
            return redirect()->route('update');
        }

        // This is an example to demonstrate the possibility to prevent the switch the to stable channel when incompatible
        // changes have been applied to the database
        if(version_compare($current_version, '2.13.3b', '<=')){
            return view('offline.update.cannot_switch_to_stable', [
                'current_version' => $current_version
            ]);
        }

        SoftwareUpdater::setCurrentChannel(SoftwareUpdater::STABLE_CHANNEL);

        return redirect()->route('update');
    }


}
