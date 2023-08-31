<?php

namespace AndreaMarelli\ModularForms\Helpers\File;

use AndreaMarelli\ModularForms\Helpers\Type\Chars;
use Illuminate\Http\Testing\MimeType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class File
{
    public const PUBLIC_STORAGE = 'public';
    public const TEMP_STORAGE = 'temp';

    use Export;
    use Hash;

    /**
     * Clean filename (allows only letters, digits, "_" and  "-" )
     *
     * @param $original_filename
     * @return string
     */
    public static function cleanFileName($original_filename): string
    {
        $info             = pathinfo($original_filename);
        $cleaned_filename = basename($original_filename, '.' . $info['extension']);
        $cleaned_filename = str_replace('  ', '_', $cleaned_filename);
        $cleaned_filename = str_replace(' ', '_', $cleaned_filename);
        $cleaned_filename = Chars::replaceAccents($cleaned_filename);
        $cleaned_filename = Chars::clean($cleaned_filename, '_-');
        return $cleaned_filename . '.' . $info['extension'];
    }

    /**
     *  Convert bytes to human-readable format
     *
     * @param int $bytes size in bytes
     * @param int $precision (optional) number of precision digits
     * @param string $fixedUnit (optional) force the scale unit (allowed values: B, KB, MB, GB, TB)
     *
     * @return string
     */
    public static function readableBytes(int $bytes, int $precision = 2, string $fixedUnit = ''): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow   = '';
        if ($fixedUnit != '') {
            $pow = array_search(strtoupper($fixedUnit), $units);
        }
        if ($pow == '') {
            $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
            $pow = min($pow, count($units) - 1);
        }
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * List files in the given directory (by type)
     *
     * @param string $dir the directory to be listed
     * @param string $extension [optional] the type of files to list        default: ALL
     * @return  array
     */
    public static function listFiles(string $dir, string $extension = ''): array
    {
        $files = array();
        if (is_dir($dir)) {
            if ($handle_dir = opendir($dir)) {
                while (($filename = readdir($handle_dir)) !== false) {
                    if ($filename != '.' && $filename != '..') {
                        switch ($extension) {
                            case '':
                            case 'ALL':
                                array_push($files, $filename);
                                break;
                            default:
                                if (strtolower(strrchr($filename, '.')) == '.' . $extension) {
                                    array_push($files, $filename);
                                }
                                break;
                        }
                    }
                }
                closedir($handle_dir);
            }
        }
        sort($files, SORT_LOCALE_STRING);
        return $files;
    }

    /**
     * Send the file through response (download)
     *
     * @param $filePath
     * @param null $fileName
     * @return BinaryFileResponse
     */
    public static function download($filePath, $fileName = null): BinaryFileResponse
    {
        $fileName = $fileName ?? basename($filePath);
        return response()
            ->download($filePath, $fileName);
    }


    /**
     * Get the media type from the filename
     * Possible Media Types : document / image / audio / video / archive / other
     *
     * @param $filename
     * @return string
     */
    public static function getMediaType($filename): string
    {
        $mimeType = MimeType::from($filename);

        if (mb_substr_count($mimeType, 'document') > 0 ||
            mb_substr_count($mimeType, 'msword') > 0 ||
            mb_substr_count($mimeType, 'ms-word') > 0 ||
            mb_substr_count($mimeType, 'excel') > 0 ||
            mb_substr_count($mimeType, 'powerpoint') > 0 ||
            mb_substr_count($mimeType, 'mspublisher') > 0) {
            return 'document';
        } elseif (mb_substr_count($mimeType, 'pdf') > 0) {
            return 'pdf';
        } elseif (mb_substr_count($mimeType, 'image') > 0) {
            return 'image';
        } elseif (mb_substr_count($mimeType, 'audio') > 0) {
            return 'audio';
        } elseif (mb_substr_count($mimeType, 'video') > 0) {
            return 'video';
        } elseif (mb_substr_count($mimeType, 'zip') > 0 ||
            mb_substr_count($mimeType, 'rar') > 0 ||
            mb_substr_count($mimeType, '7z') > 0 ||
            mb_substr_count($mimeType, 'cab') > 0 ||
            mb_substr_count($mimeType, 'tar') > 0) {
            return 'archive';
        } else {
            return 'other';
        }
    }

}
