<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ModularForms\Helpers\File\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

trait Backup{

    private $BACKUP_DISK = File::PUBLIC_STORAGE;
    private $BACKUP_FOLDER = 'backups/';

    private $MAX_NUM_BACKUPS = 5;  // per each imet
    private $MIN_MINUTES_DIFF = 90;

    /**
     * Perform IMET backup if necessary (analyze existing ones)
     *
     * @param $item
     */
    public function backup($item)
    {
        if(App::environment('imetoffline')){

            $form = (new Imet())->find($item);
            $now = Carbon::now();
            $fileName = $this->backup_filename($form, $now);

            // Retrieve existing backups
            $form_backups = $this->retrieve_existing_backups($item);
            $num_backups = count($form_backups);

            // no previous backups exist
            if($num_backups === 0){
                $this->execute_backup($form, $fileName);
            }
            // previous backups exist
            else {
                $oldest_backup = reset($form_backups);
                $last_backup = last($form_backups);
                [$_, $_, $_, $bck_date] = explode('_', str_replace('.json','',$last_backup));
                $bck_date = Carbon::createFromFormat('Y-m-d-H-i-s',  $bck_date);
                // More than $MIN_MINUTES_DIFF from last backup
                if($bck_date->diffInMinutes($now) > $this->MIN_MINUTES_DIFF){
                    // remove oldest backup when max num reached
                    if($num_backups === $this->MAX_NUM_BACKUPS){
                        Storage::disk($this->BACKUP_DISK)->delete($oldest_backup);
                    }
                    $this->execute_backup($form, $fileName);
                }
            }

        }
    }

    /**
     * Generate a filename for the backup
     *
     * @param $form
     * @param $now
     * @return string
     */
    private function backup_filename($form, $now): string
    {
        $wdpa_id = ProtectedAreaNonWdpa::isNonWdpa($form->wdpa_id) ? '' : '_' . $form->wdpa_id;
        return 'IMET' .
            $wdpa_id  .
            '_' . $form->Year .
            '_' . $form->FormID .
            '_' . $now->format('Y-m-d-H-i-s') .
            '.json';
    }

    /**
     * Retrieve existing backups from filesystem
     *
     * @param $imet_id
     * @return array
     */
    private function retrieve_existing_backups($imet_id): array
    {
        $all_backups = Storage::disk($this->BACKUP_DISK)->files($this->BACKUP_FOLDER);
        asort($all_backups);
        $form_backups = [];
        foreach ($all_backups as $backup){
            [$_, $_, $bck_form_id, $_] = explode('_', str_replace('.json','',$backup));
            if($bck_form_id === $imet_id){
                $form_backups[] = $backup;
            }
        }
        return $form_backups;
    }

    private function execute_backup($form, $filename)
    {
        $path = Storage::disk($this->BACKUP_DISK)->path($this->BACKUP_FOLDER);
        $json = $this->export($form, false, false);
        $handle = fopen($path. $filename, 'w');
        fwrite($handle, json_encode($json));
        fclose($handle);
    }

}
