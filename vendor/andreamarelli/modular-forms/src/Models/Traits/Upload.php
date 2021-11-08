<?php

namespace AndreaMarelli\ModularForms\Models\Traits;

use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDO;

trait Upload {

    public static $UPLOAD_DISK = File::PUBLIC_STORAGE;
    public static $UPLOAD_PATH = 'temp/';
    protected static $DOWNLOAD_ROUTE=  '/file/';

    public static $upload_object =  [
        'original_filename' => null,
        'temp_filename' => null,
        'changed' => false,
        'download_link' => null
    ];

    public static $binary_field_prefix ='_BYTEA';

    /**
     * Upload: get file from client request and save it in a temporary file in storage
     *
     * @param $uploaded_file
     * @return array|null
     */
    public static function uploadFile($uploaded_file): ?array
    {
        $temp_filename = Storage::disk(self::$UPLOAD_DISK)->putFile(static::$UPLOAD_PATH, $uploaded_file);
        $original_filename = $uploaded_file->getClientOriginalName();
        if($temp_filename){
            $temp_filename = basename($temp_filename);
            return [
                'original_filename' => $original_filename,
                'temp_filename' => $temp_filename,
                'changed' => true,
                'download_link' => static::getUrlByHash(
                    File::encodeHash([
                                         'temp_filename' => $temp_filename,
                                         'original_filename' => $original_filename
                                     ])
                )
            ];

        }
        return null;

    }

    /**
     * Retrieve model's upload fields
     * @param bool $withBinaryFields
     * @return mixed
     */
    public static function getUploadFields($withBinaryFields = false)
    {
        $model = new static();
        return collect(
            array_merge($model->module_fields, $model->module_common_fields)
        )
            ->filter(function ($item) {
                return $item['type'] === 'upload';
            })
            ->pluck('name')
            ->map(function ($item) use ($withBinaryFields){
                return ($withBinaryFields)
                    ? $item.static::$binary_field_prefix
                    : $item;
            })
            ->toArray();
    }

    /**
     * Retrieve file URL from hash
     *
     * @param $hash
     * @return string
     */
    public static function getUrlByHash($hash): string
    {
        return url('/')
            .static::$DOWNLOAD_ROUTE
            .$hash;
    }

    /**
     * Get file hash from Model
     *
     * @param $class
     * @param $field
     * @param $id
     * @return string
     */
    public static function getFileModelHash($class, $field, $id): string
    {
        return File::encodeHash([
                                    'model' => $class,
                                    'field' => $field,
                                    'id' => $id
                                ]);
    }

    /**
     * Retrieve file by hash
     *
     * @param $hash
     * @return array|null[]
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getFileByHash($hash): array
    {
        $params = File::decodeHash($hash);
        if($params === null) abort('404');
        if(array_key_exists('model', $params)){
            $model = $params['model']::find($params['id']);
            $file_name = $model->{$params['field']};
            $file_content = $model->{$params['field'].Upload::$binary_field_prefix};
            if($file_content === null) abort('404');
            return [$file_content, $file_name];
        } elseif(array_key_exists('temp_filename', $params)){
            $file_content = Storage::disk(self::$UPLOAD_DISK)->get(static::$UPLOAD_PATH.$params['temp_filename']);
            $file_name = $params['original_filename'];
            return [$file_content, $file_name];
        }
        return [null, null];
    }

    /**
     * Retrieve file type by hash
     *
     * @param $hash
     * @return string|null
     */
    public static function getFileTypeByHash($hash): ?string
    {
        $params = File::decodeHash($hash);
        if($params === null) abort('404');

        if(array_key_exists('model', $params) && $params['id'] !== null){
            $file_name = $params['model']::find($params['id'], [$params['field']])->{$params['field']};
            return File::getMediaType($file_name);
        }
        return null;
    }


    /**
     * Explode upload field
     *
     * @param Collection $collection
     * @return mixed
     */
    public static function parse_uploads_from_model(Collection $collection): Collection
    {
        if(!$collection->isEmpty()){

            $primary_key = (new static())->primaryKey;
            $upload_fields = static::getUploadFields();

            if(!empty($upload_fields)){
                foreach ($upload_fields as $upload_field){
                    $collection = $collection->map(function ($item) use ($upload_field, $primary_key) {
                        if($item[$upload_field]!==null){
                            $item[$upload_field] = [
                                'original_filename' => $item[$upload_field],
                                'temp_filename' => null,
                                'changed' => false,
                                'download_link' => static::getUrlByHash(
                                    static::getFileModelHash(
                                        static::class,
                                        $upload_field,
                                        $item->{$item->getKeyName()}
                                    )
                                )
                            ];
                        } else {
                            $item[$upload_field] = static::$upload_object;
                        }
                        return $item;
                    });
                }
            }
        }

        return $collection;
    }

    /**
     * Check if any file had been uploaded and extract from $this->attributes (will be saved with dedicated query statement)
     *
     * @return array
     */
    private function parse_uploads(): array
    {
        $upload_fields = static::getUploadFields();
        $uploads = [];

        if(!empty($upload_fields)) {
            foreach ($this->attributes as $name => $_) {
                if (in_array($name, $upload_fields)) {

                    if (gettype($this->attributes[$name]) === 'array' && $this->attributes[$name]['changed'] === true) {

                        // File just uploaded (file is actually in temp folder)
                        if ($this->attributes[$name]['temp_filename'] !== null) {
                            $uploads[$name] = [
                                'path' => $this->attributes[$name]['temp_filename'],
                                'original_filename' => $this->attributes[$name]['original_filename']
                            ];
                        }

                        // File removed
                        elseif ($this->attributes[$name]['temp_filename'] === null) {
                            $uploads[$name] = null;
                        }
                    }

                    // From JSON import
                    elseif (gettype($this->attributes[$name]) === 'string') {
                        if(array_key_exists($name . static::$binary_field_prefix, $this->attributes)){
                            $uploads[$name] = [
                                'file_content' => $this->attributes[$name . static::$binary_field_prefix],
                                'original_filename' => $this->attributes[$name]
                            ];
                            unset($this->attributes[$name . static::$binary_field_prefix]);
                        }
                    }

                    unset($this->attributes[$name]);
                }
            }
        }
        return $uploads;
    }

    /**
     * Store uploaded files into DB with dedicated RAW statement
     *
     * @param $uploads
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function save_uploads($uploads)
    {
        if(!empty($uploads)){

            $storage = Storage::disk(self::$UPLOAD_DISK);

            foreach ($uploads as $field_key=>$upload){
                $fileName = $fileContent = null;

                if($upload!==null){

                    // From uploaded file
                    if(array_key_exists('path', $upload)){
                        $fileName = $upload['original_filename'];
                        $fileContent = $storage->get(self::$UPLOAD_PATH.$upload['path']);
                    }
                    // From JSON import
                    elseif(array_key_exists('file_content', $upload)){
                        $fileName = $upload['original_filename'];
                        $fileContent = base64_decode($upload['file_content']);
                    }

                }
                static::saveFileToDB($this->{$this->primaryKey}, $field_key, $fileName, $fileContent);
            }
        }
    }

    /**
     * Execute dedicated DB RAW statement
     *
     * @param $id
     * @param $field_key
     * @param $fileName
     * @param $fileContent
     */
    protected static function saveFileToDB($id, $field_key, $fileName, $fileContent)
    {
        $model = new static();
        $sql = 'UPDATE "'.str_replace('.', '"."', $model->getTable()).'"
                    SET "'.$field_key.'"=:filename,
                        "'.$field_key.static::$binary_field_prefix.'"=:file_bytea
                    WHERE "'.$model->primaryKey.'"=:id;';
        $pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':filename', $fileName);
        $stmt->bindValue(':file_bytea', $fileContent, PDO::PARAM_LOB);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    /**
     * Return fileContent of an upload
     *
     * @param $upload
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getUploadFileContent($upload): string
    {
        $storage = Storage::disk(self::$UPLOAD_DISK);
        return $storage->get(self::$UPLOAD_PATH.$upload['temp_filename']);
    }

    /**
     * Return file info of uploaded file
     *
     * @param $upload
     * @return array
     */
    public static function getUploadFileInfo($upload): array
    {
        $storage = Storage::disk(self::$UPLOAD_DISK);
        $path = self::$UPLOAD_PATH.$upload['temp_filename'];
        return [
            'size' => $storage->size($path),
            'format' => File::getMediaType($storage->path($path))
        ];
    }

}
