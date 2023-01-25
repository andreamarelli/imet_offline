<?php

namespace AndreaMarelli\ImetCore\Jobs;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ModularForms\Helpers\Module;
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
            [\AndreaMarelli\ImetCore\Models\Imet\v1\Imet::$modules,],
            __NAMESPACE__ . '\PopulateMetadata::insert_metadata',
            [Imet::IMET_V1, 'context']
        );
        Module::iterateOverModules(
            [\AndreaMarelli\ImetCore\Models\Imet\v1\Imet_Eval::$modules,],
            __NAMESPACE__ . '\PopulateMetadata::insert_metadata',
            [Imet::IMET_V1, 'evaluation']
        );
        Module::iterateOverModules(
            [\AndreaMarelli\ImetCore\Models\Imet\v2\Imet::$modules,],
            __NAMESPACE__ . '\PopulateMetadata::insert_metadata',
            [Imet::IMET_V2, 'context']
        );
        Module::iterateOverModules(
            [\AndreaMarelli\ImetCore\Models\Imet\v2\Imet_Eval::$modules,],
            __NAMESPACE__ . '\PopulateMetadata::insert_metadata',
            [Imet::IMET_V2, 'evaluation']
        );

        // metadata statistics
        DB::select('DELETE FROM imet.imet_metadata_statistics;');
        $items = trans('imet-core::v2_common.assessment');
        foreach ($items as $code => $item) {
            static::insert_metadata_statistics(Imet::IMET_V2, $code, $item);
        }
        $items = trans('imet-core::v1_common.assessment');
        foreach ($items as $code => $item) {
            static::insert_metadata_statistics(Imet::IMET_V1, $code, $item);
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
        if ($version === Imet::IMET_V1 && preg_match("/^Objectives\d$/", $className)) {
            $className = 'Objectives';
        } elseif ($version === Imet::IMET_V2 && Str::startsWith($className, 'Objectives')) {
            $className = 'Objectives';
        }
        return str_replace(
            "'",
            "''",
            trans('imet-core::' . $version . '_' . $phase . '.' . $className . '.title', [], $lang)
        );
    }

    public static function insert_metadata_statistics($version, $code, $labels)
    {
        $label_en = str_replace("'", "''", trans('imet-core::' . $version . '_common.assessment.' . $code, [], 'en')[1]);
        $label_fr = str_replace("'", "''", trans('imet-core::' . $version . '_common.assessment.' . $code, [], 'fr')[1]);

        DB::select(
            "INSERT into imet.imet_metadata_statistics
          (version, code, code_label, title_fr, title_en)
          VALUES ('" . $version . "', '" . $code . "', '" . $labels[0] . "', '" . $label_fr . "', '" . $label_en . "');"
        );
    }

}
