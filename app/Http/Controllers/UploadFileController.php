<?php

namespace App\Http\Controllers;

use App\Library\Utils\File\File;
use App\Models\Components\Module;
use App\Models\Components\Upload;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class UploadFileController extends Controller
{
    /**
     * Upload file
     * @param Request $request
     * @return array|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function upload(Request $request)
    {
        $uploaded = Upload::uploadFile($request->file('file_upload'));
        if($uploaded!==null){
            return $uploaded;
        } else {
            throw new BadRequestHttpException();
        }
    }


    /**
     * Download file (by hash)
     * @param $hash
     * @return File
     */
    public static function download($hash)
    {
        [$file_content, $file_name] = Module::getFileByHash($hash);
        $disk = \Storage::disk(File::PRIVATE_STORAGE);
        $disk->put($hash, $file_content);
        $file_path = $disk->path($hash);
        return response()
            ->download($file_path, $file_name)
            ->deleteFileAfterSend();
    }


}