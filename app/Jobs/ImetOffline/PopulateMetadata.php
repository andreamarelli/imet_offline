<?php

namespace App\Jobs\ImetOffline;

use App\Jobs\Utils;
use App\Library\Ofac\Module;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PopulateMetadata implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // metadata
        DB::select('DELETE FROM imet.imet_metadata;');
        Module::iterateOverModules(
            [\App\Models\Imet\v1\Imet::$modules,],
            __NAMESPACE__ . '\PopulateMetadata::insert_metadata',
            ['v1', 'context']
        );
        Module::iterateOverModules(
            [\App\Models\Imet\v1\Imet_Eval::$modules,],
            __NAMESPACE__ . '\PopulateMetadata::insert_metadata',
            ['v1', 'evaluation']
        );
        Module::iterateOverModules(
            [\App\Models\Imet\v2\Imet::$modules,],
            __NAMESPACE__ . '\PopulateMetadata::insert_metadata',
            ['v2', 'context']
        );
        Module::iterateOverModules(
            [\App\Models\Imet\v2\Imet_Eval::$modules,],
            __NAMESPACE__ . '\PopulateMetadata::insert_metadata',
            ['v2', 'evaluation']
        );

        // metadata statistics
        DB::select('DELETE FROM imet.imet_metadata_statistics;');
        $items = trans('form/imet/v2/common.assessment');
        foreach ($items as $code => $item) {
            static::insert_metadata_statistics('v2', $code, $item);
        }
        $items = trans('form/imet/v1/common.assessment');
        foreach ($items as $code => $item) {
            static::insert_metadata_statistics('v1', $code, $item);
        }
    }

    public static function insert_metadata($args)
    {
        $moduleClass = array_shift($args);
        $module      = new $moduleClass();

        DB::select(
            "INSERT into imet.imet_metadata
        (version, phase, code, db_table, title_fr, title_en)
          VALUES ('" . $args[0] . "',
              '" . $args[1] . "',
              '" . $module->module_code . "',
              '" . str_replace('imet.', '', $module->getTable()) . "',
              '" . static::getModuleTitle($args[0], $args[1], $module->getShortClassName(), 'fr') . "',
              '" . static::getModuleTitle($args[0], $args[1], $module->getShortClassName(), 'en') . "');"
        );
    }

    public static function getModuleTitle($version, $phase, $className, $lang)
    {
        if ($version === 'v1' && preg_match("/^Objectives\d$/", $className)) {
            $className = 'Objectives';
        } elseif ($version === 'v2' && Str::startsWith($className, 'Objectives')) {
            $className = 'Objectives';
        }
        return str_replace(
            "'",
            "''",
            trans('form/imet/' . $version . '/' . $phase . '.' . $className . '.title', [], $lang)
        );
    }

    public static function insert_metadata_statistics($version, $code, $labels)
    {
        $label_en = str_replace("'", "''", trans('form/imet/' . $version . '/common.assessment.' . $code, [], 'en')[1]);
        $label_fr = str_replace("'", "''", trans('form/imet/' . $version . '/common.assessment.' . $code, [], 'fr')[1]);

        DB::select(
            "INSERT into imet.imet_metadata_statistics
          (version, code, code_label, title_fr, title_en)
          VALUES ('" . $version . "', '" . $code . "', '" . $labels[0] . "', '" . $label_fr . "', '" . $label_en . "');"
        );
    }

}
