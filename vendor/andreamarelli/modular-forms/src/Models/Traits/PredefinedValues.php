<?php

namespace AndreaMarelli\ModularForms\Models\Traits;


use Illuminate\Support\Str;

trait PredefinedValues {

    protected ?array $predefined_values = null;


    /**
     * Get predefined_values
     */
    protected static function getPredefined($form_id = null): ?array
    {
        return (new static())->predefined_values;
    }


    /**
     * Re-organize records according to predefined_values
     */
    protected static function arrange_records_with_predefined($form_id, $records, $empty_record): array
    {
        $predefined_values = static::getPredefined($form_id);
        return static::arrange_records($predefined_values, $records, $empty_record);
    }

    /**
     * Re-organize records
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        if($predefined_values!==null && $predefined_values['values']!==null){

            $module_type = (new static())->module_type;
            $group_key_field = static::$group_key_field;

            $predefined_field = $predefined_values['field'];
            $new_records = [];

            if(!empty($records)) {
                if (!array_key_exists((new static())->primaryKey, $records[0])) {
                    $records[0][(new static())->primaryKey] = null;
                }
                if (count($predefined_values['values']) >= 1
                    && count($records) == 1
                    && $records[0][(new static())->primaryKey] == null
                ) {
                    $records = [];
                }
            }

            // For TABLE and ACCORDION
            if($module_type=='TABLE' || $module_type=='ACCORDION'){
                foreach($predefined_values['values'] as $i => $predefined_value){
                    $new_record = $empty_record;
                    foreach($records as $r=>$record){
                        if($record[$predefined_field] == $predefined_value){
                            $new_record = $record;
                            unset($records[$r]);
                            break;
                        }
                    }
                    $new_record[$predefined_field] = $predefined_value;
                    $new_record['__predefined'] = true;
                    if(array_key_exists('labels', $predefined_values)){
                        $new_record['__predefined_label'] = $predefined_values['labels'][$i];
                    }

                    $new_records[] = $new_record;
                }
                if(count($records)>0){
                    foreach($records as $r => $record){
                        $new_records[] = $record;
                    }
                }

                $records = $new_records;
            }

            // For GROUP_TABLE and GROUP_ACCORDION
            elseif(Str::contains($module_type, 'GROUP_')){
                foreach($predefined_values['values'] as $g => $group){
                    if(count($group)>0){
                        foreach($group as $p => $predefined_value){
                            $new_record = $empty_record;
                            foreach($records as $r => $record){
                                if($record[$predefined_field] == $predefined_value
                                        && $record[$group_key_field] == $g){
                                    $new_record = $record;
                                    unset($records[$r]);
                                    break;
                                }
                            }
                            $new_record[$predefined_field] = $predefined_value;
                            $new_record[$group_key_field] = $g;
                            $new_record['__predefined'] = true;
                            $new_records[] = $new_record;
                        }
                    }
                }

                // Add remaining records (without predefined)
                if(count($records)>0){
                    foreach($records as $r => $record){
                        $new_record = $record;
                        $new_record['__predefined'] = false;
                        $new_records[] = $record;
                    }
                }
                $records = $new_records;
            }
        }
        return $records;
    }

}
