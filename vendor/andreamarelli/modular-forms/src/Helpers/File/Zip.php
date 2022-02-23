<?php


namespace AndreaMarelli\ModularForms\Helpers\File;

use Illuminate\Support\Facades\Storage;
use ZipArchive;
use AndreaMarelli\ModularForms\Models\Traits\Upload;

class Zip
{
    /**
     * retrieve zip file from temp folder open it and extract files
     * @param string $zip_path
     * @return array
     */
    public static function extract(string $zip_path): array
    {
        $zip_path = $zip_path===basename($zip_path)
            ? Storage::disk(File::PUBLIC_STORAGE)->path(Upload::$UPLOAD_PATH) . $zip_path
            : $zip_path;
        $path = rtrim(dirname($zip_path), '/') . '/';

        $files = [];

        // Read ZIP archive and files
        $zip = new ZipArchive;
        $zipStatus = $zip->open($zip_path);
        if ($zipStatus !== true) {
            return $files;
        }
        for ($i = 0; $i < $zip->count(); $i++) {
            $files[] = $zip->getNameIndex($i);
        }

        $zip->extractTo($path, $files);
        $zip->close();

        File::removeFiles([$zip_path], FILE::PUBLIC_STORAGE, "temp/");
        return [$files, $path];
    }


    /**
     * pass an array of files to add them in a zip
     * @param array $files
     * @param string $zip_path
     * @param bool $remove_files
     * @return string
     */
    public static function compress(array $files, string $zip_path, bool $remove_files = true) : string
    {
        $zip_path = $zip_path===basename($zip_path)
            ? Storage::disk(File::PRIVATE_STORAGE)->path('') . $zip_path
            : $zip_path;

        // Create ZIP and add files
        $zip = new ZipArchive();
        $zip->open($zip_path, \ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
        $zip->close();

        // Remove source files
        if ($remove_files) {
            File::removeFiles($files);
        }

        return $zip_path;
    }
}
