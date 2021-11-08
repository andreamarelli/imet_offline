<?php


namespace AndreaMarelli\ModularForms\Helpers\File;

use Illuminate\Support\Facades\Storage;
use ZipArchive;
use AndreaMarelli\ModularForms\Models\Traits\Upload;

class Compress
{
    /**
     * retrieve zip file from temp folder open it and extract files
     * @param string $file
     * @param array $fileTypeToCheck
     * @param int $filesToExtract
     * @return array
     */
    public static function extractFilesFromZipFile(string $file, array $fileTypeToCheck = ['json'], int $filesToExtract = 10): array
    {
        $folder = File::PUBLIC_STORAGE . '/' . Upload::$UPLOAD_PATH;
        $fullPath = Storage::path($folder);
        $filename = $fullPath . $file;
        $files = [];

        $zip = new ZipArchive;
        $zipStatus = $zip->open($filename);
        if ($zipStatus !== true) {
            return $files;
        }

        for ($i = 0; $i < $zip->count(); $i++) {
            $file = $zip->getNameIndex($i);
            if ($i < $filesToExtract && in_array(substr($file, -4), $fileTypeToCheck, true)) {
                $files[] = $zip->getNameIndex($i);
            }
        }

        $zip->extractTo($fullPath, $files);
        $zip->close();
        File::removeFiles([$filename], FILE::PUBLIC_STORAGE, "temp/");
        return $files;
    }


    /**
     * pass an array of files to add them in a zip
     * @param array $files
     * @param string $name
     * @param bool $remove_files
     * @return string
     */
    public static function zipFile(array $files, string $name = "IMETS_", bool $remove_files = true) : string
    {
        $fileName = $name . count($files) . "_" . date('m-d-Y_hisu') . ".zip";
        $store = Storage::disk(File::PRIVATE_STORAGE)->path('') . $fileName;
        $zip = new ZipArchive();

        $zip->open($store, \ZipArchive::CREATE);

        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }

        $zip->close();

        if ($remove_files) {
            File::removeFiles($files);
        }

        return $store;
    }
}
