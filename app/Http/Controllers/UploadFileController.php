<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Imet\ImetController;
use App\Library\Utils\File\File;
use App\Models\Components\Module;
use App\Models\Components\Upload;
use Illuminate\Http\Request;
use Str;


class UploadFileController extends Controller
{
    /**
     * Upload file
     * @param Request $request
     * @return json|null
     */
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->extension();
        $files = null;
        try {
            $uploaded = Upload::uploadFile($file);
            $json = json_decode(Upload::getUploadFileContent($uploaded), true);
            $files = (new ImetController())->import(new Request(), $json, false);

            if (is_null($files) || $files["status"] === "error") {
                return response()->json(["message" => trans('common.upload.no_files_found')], 500);
            }

        } catch (\Exception $e) {
            report($e);
            return response()->json(["message" => trans('common.upload.generic_error')], 500);
        }

        return response()->json($files);
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