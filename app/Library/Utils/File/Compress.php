<?php


namespace App\Library\Utils\File;

use Storage;
use ZipArchive;

class Compress
{
    /**
     * pass an array of files to add them in a zip
     * @param array $files
     * @return string
     */
    public static function zipFile(array $files)
    {
        $fileName = "IMETS_" . count($files) . "_" . date('m-d-Y_hisu') . ".zip";
        $store = Storage::disk(File::PRIVATE_STORAGE)->path('') . $fileName;
        $zip = new ZipArchive();
        $zip->open($store, \ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }

        $zip->close();
        File::removeFiles($files);
        return $store;
    }


}