<?php

namespace App\Library\Utils\File;

use App\Models\Components\Upload;

class Compress
{
    /**
     * retrieve zip file from temp folder open it and extract files
     * @param string $file
     * @param array $fileTypeToCheck
     * @param int $filesToExtract
     * @return array
     */
    public static function extractFilesFromZipFile(string $file, array $fileTypeToCheck = ['json'], int $filesToExtract = 5): array
    {
        $folder = File::PUBLIC_STORAGE . '/' . Upload::$UPLOAD_PATH;
        $fullPath = \Storage::path($folder);
        $filename = $fullPath . $file;
        $files = [];

        $zip = new \ZipArchive;
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
}