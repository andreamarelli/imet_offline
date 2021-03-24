<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Imet\ImetController;
use App\Library\Utils\File\Compress;
use App\Library\Utils\File\File;
use App\Models\Components\Module;
use App\Models\Components\Upload;
use Illuminate\Http\Request;


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
        $files = [];
        try {
            //upload file
            $uploaded = Upload::uploadFile($file);
            $import = new ImetController();
            //and then check if is zip or json
            if (in_array($ext, ['zip'])) {
                $extractFiles = Compress::extractFilesFromZipFile($uploaded['temp_filename']);

                foreach ($extractFiles as $item) {
                    $json = json_decode(Upload::getUploadFileContent(['temp_filename' => $item]), true);
                    $files[] = $import->import(new Request(), $json, false);
                    File::removeFiles([$item], FILE::PUBLIC_STORAGE, "temp/");
                }
            } else {
                $json = json_decode(Upload::getUploadFileContent($uploaded), true);
                $files[] = $import->import(new Request(), $json, false);
                File::removeFiles([$uploaded['temp_filename']], FILE::PUBLIC_STORAGE, "temp/");
            }

            if (count($files) === 0 || (count($files) === 1 && isset($files[0]) && $files[0]['status'] === 'error')) {
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