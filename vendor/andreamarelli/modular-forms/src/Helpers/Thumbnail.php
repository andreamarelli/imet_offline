<?php

namespace AndreaMarelli\ModularForms\Helpers;

use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ModularForms\Models\Module;
use Exception;
use Intervention\Image\Facades\Image;
use Imagick;
use Illuminate\Support\Facades\Storage;

class Thumbnail {

    public const THUMB_PATH = 'thumbnails/';
    public const THUMB_FORMAT = 'jpg';
    public const THUMB_MAX_WIDTH = 130;

    /**
     * Get the path of the thumbnail
     *
     * @param $hash
     * @return string
     */
    private static function path($hash): string
    {
        return static::THUMB_PATH.$hash.'.'.static::THUMB_FORMAT;
    }

    /**
     * Check if the thumbnail exists. If not will be created (if possible)
     *
     * @param $hash
     * @return bool
     */
    public static function exists($hash): bool
    {
        return static::getByHash($hash)!==null;
    }

    /**
     * Get thumbnail (file stream content) by hash
     *
     * @param $hash
     * @return string|null
     */
    public static function getByHash($hash): ?string
    {
        $thumbnail_path = static::path($hash);
        $disk = Storage::disk(File::PUBLIC_STORAGE);
        if(!$disk->exists($thumbnail_path)){
            return null;
        }
        return $disk->path($thumbnail_path);
    }

    /**
     * Generate thumbnail (by hash)
     *
     * @param $hash
     * @return null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function generateByHash($hash): ?string
    {
        $thumb = null;
        $thumbnail_path = static::path($hash);
        $media_type = Module::getFileTypeByHash($hash);

        if($media_type==='image' || $media_type==='pdf'){
            [$original_file_content, $original_file_name] = Module::getFileByHash($hash);
            if($original_file_content==null) return null;
            $original_file_temp_path = $hash.'.'.pathinfo($original_file_name, PATHINFO_EXTENSION);
            Storage::disk(File::TEMP_STORAGE)->put($original_file_temp_path, $original_file_content);
            try{
                $thumb = static::generate($original_file_temp_path, $thumbnail_path, null, static::THUMB_MAX_WIDTH);
            } catch (Exception $e){}

            Storage::disk(File::TEMP_STORAGE)->delete($original_file_temp_path);
        }

        return $thumb;
    }

    /**
     * Generate a thumbnail of the given file
     *
     * @param $source_file_path
     * @param $thumbnail_filename
     * @param int|null $height
     * @param int|null $width
     * @return string
     * @throws \ImagickException
     */
    private static function generate($source_file_path, $thumbnail_filename, int $height = null, int $width = null): string
    {
        $source_file_path = Storage::disk(File::TEMP_STORAGE)->path($source_file_path);
        $quality = 70;
        $media_type = File::getMediaType($source_file_path);

        // #########  Images  #########
        if($media_type == 'image') {
            $thumbnail = Image::make($source_file_path);
            if($height!==null && $width!==null){
                $thumbnail->resize($width, $height);
            } elseif($height===null || $width===null){
                $thumbnail->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $thumbnail->encode(static::THUMB_FORMAT, $quality);
            Storage::disk(File::PUBLIC_STORAGE)->put($thumbnail_filename, $thumbnail);
        }

        // #########  PDFs  #########
        elseif($media_type == 'pdf') {
            $thumbnail_filename = Storage::disk(File::PUBLIC_STORAGE)->path($thumbnail_filename);
            $thumbnail = new Imagick();
            $thumbnail->readImage($source_file_path.'[0]');
            $thumbnail->resizeImage(static::THUMB_MAX_WIDTH, 500, Imagick::FILTER_LANCZOS, 1, true);
            $thumbnail->setImageBackgroundColor('white');
            $thumbnail->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
            $thumbnail->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
            $thumbnail->setImageFormat('jpg');
            $thumbnail->writeImage($thumbnail_filename);
        }

        return $thumbnail_filename;
    }

}
