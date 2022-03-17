<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Component;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

/**
 * @method static conversionDataReview(array $record)
 * @method static conversionParameters()
 */
trait ConvertSQLite{

    /**
     * Convert ProtectedAreaID to WDPA from SQLITE knowledgebase
     *
     * @param $id
     * @param $sqlite_connection
     * @return string|null
     */
    public static function wdpaBySqliteProtectedAreaID($id, $sqlite_connection): ?string
    {
        $knowledge_base = $sqlite_connection->table('knowledgebase_protectedareas')
            ->select()
            ->where('id', $id)
            ->first();
        return $knowledge_base ? trim($knowledge_base->WDPA) : null;
    }

    /**
     * Identify PA (wdpa or name)
     *
     * @param $imet
     * @param $sqlite_connection
     * @return array|null[]
     */
    public static function identifySqlitePa($imet, $sqlite_connection): array
    {
        // Try to retrieve WPDA
        $knowledge_base = $sqlite_connection->table('knowledgebase_protectedareas')
            ->select()
            ->where('id', $imet->ProtectedAreaID)
            ->first();
        $wdpa = $knowledge_base->WDPA ?? null;
        if($wdpa === null){
            $general_info = $sqlite_connection->table('ProtectedAreas_GeneralInfo')
                ->select(['CompleteName', 'CompleteNameWDPA', 'UsedName', 'WDPA'])
                ->where('FormID', $imet->FormID)
                ->first();
            $wdpa = trim($general_info->WDPA ?? null) ?? null;
        }

        // Valid WDPA found
        if(!empty($wdpa)
            && $pa = ProtectedArea::where('wdpa_id', $wdpa)->first()){
            return [$wdpa, $pa->name];
        }

        // NO valid WDPA: return only name
        return [null, $general_info->CompleteNameWDPA
            ?? $general_info->CompleteName
            ?? $general_info->UsedName
            ?? $knowledge_base->PaName
            ?? null];
    }

    /**
     * Execute conversion of OLD SQLite IMET to array
     *
     * @param $imet_data
     * @param \Illuminate\Database\ConnectionInterface $sqlite_connection
     * @return array
     */
    protected static function convert($imet_data, ConnectionInterface $sqlite_connection): array
    {
        if(!method_exists(get_called_class(), 'conversionParameters')){
            return [];
        }

        $sqlite_structure = static::conversionParameters();

        return $sqlite_connection->table('ProtectedAreas_'.$sqlite_structure['table'])
            ->select()
            ->where('FormID', $imet_data->FormID)
            ->where($sqlite_structure['query_conditions'] ?? [])
            ->get()
            ->map(function($record) use ($sqlite_structure, $sqlite_connection){

                $record = (array) $record;
                $json = [];

                // Review data from SQLITE whenever necessary
                if(method_exists(get_called_class(), 'conversionDataReview')){
                    $record = static::conversionDataReview($record, $sqlite_connection);
                }

                // Match SQLite fields to current module fields
                $module_fields = (new static())->getModuleFieldsNames(['FILE_BINARY']);
                $sqlite_fields = $sqlite_structure['fields'];
                foreach ($module_fields as $field_idx => $field){
                    //Find and import corresponding BYTEA field
                    if(Str::contains($field, '_BYTEA')){
                        $filename_field = Str::replace('_BYTEA', '', $field);
                        $filename_field_idx = array_search($filename_field, $sqlite_fields);
                        $sqlite_filename_field = $sqlite_fields[$filename_field_idx] . '_BYTEA';
                        array_splice( $sqlite_fields, $field_idx, 0, $sqlite_filename_field);
                    }
                    // Import corresponding field
                    if($sqlite_fields[$field_idx]!==null){
                        $json[$field] = $record[$sqlite_fields[$field_idx]];
                    }
                }

                // Additional fields
                $json[static::$foreign_key] = $record['FormID'];
                $json[static::UPDATED_AT] = $record['UpdateDate'];
                unset($json['FormID']);

                return $json;
            })
            ->toArray();
    }

    /**
     * Replace OLD label with keys in the group filed of GROUP_TABLE nad GROUP_ACCORDION modules
     *
     * @param $record
     * @param $group_field
     * @return mixed
     */
    protected static function convertGroupLabelToKey($record, $group_field)
    {
        // Clean whitespaces
        $record[$group_field] = Str::replace(' ', ' ', $record[$group_field]);
        $record[$group_field] = Str::replace('  ', ' ', $record[$group_field]);
        $record[$group_field] = trim($record[$group_field]);

        // EN corresponding label
        App::setLocale('en');
        $label = array_search($record[$group_field], (new static())->module_groups);

        // FR corresponding label
        if(!$label){
            App::setLocale('fr');
            $label = array_search($record[$group_field], (new static())->module_groups);
        }

        if($label!==false){
            $record[$group_field] = $label;
        }

        if(!$label and $record[$group_field]!==''){
            dd('LABEL not found: "' . $record[$group_field] . '" (' . $group_field . ' - ' . static::class . ')');
        }

        return $record;
    }


}
