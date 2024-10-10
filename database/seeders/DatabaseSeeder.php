<?php

namespace Database\Seeders;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use AndreaMarelli\ImetCore\Models\Animal;
use Auth;
use Exception;
use Illuminate\Database\Seeder;
use AndreaMarelli\ImetCore\Models\Imet;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    const NUM_FORMS = 5;

    /**
     * @throws Exception
     */
    static function getFake($module, $field): mixed
    {
        $type = $field['type'];

        // CUSTOM
        if(Str::contains($type, '_EcosystemServicesImportance')){
            return collect([0, 1])->random();
        }

        // Standard
        if ($type === 'text') {
            return fake()->words(3);
        } elseif ($type === 'textarea' || $type === 'text-area') {
            return fake()->words(4, true);
        } elseif ($type === "url") {
            return fake()->url;
        } elseif ($type === "email") {
            return fake()->email;
        } elseif ($type === "password") {
            return fake()->password;
        } elseif ($type === "integer"
            || $type === "code"
            || $type === "numeric") {
            return fake()->randomNumber(4);
        } elseif ($type === "float"
            || $type === "currency") {
            return fake()->randomFloat(2);
        } elseif ($type === "date") {
            return fake()->date;
        } elseif ($type === "dateMaxToday") {
            return fake()->dateTimeBetween('-4 years', 'now');
        } elseif ($type === "year") {
            return fake()->year;
        } elseif ($type === "yearMaxCurrent"
            || $type === "yearMaxPrev") {
            return fake()->dateTimeBetween('-4 years', '-1 year')->format('Y');
        } elseif (Str::contains($type, '-boolean')) {
            $values = Str::contains($type, 'numeric')
                ? [0, 1]
                : ['0', '1'];
            return collect($values)->random();
        } elseif (Str::contains($type, 'yes_no')) {
            return collect(['true', 'false'])->random();
        } elseif (Str::contains($type, 'dropdown')
            || Str::contains($type, 'suggestion')
            || Str::contains($type, 'toggle')
            || Str::contains($type, 'checkbox')
            || Str::contains($type, 'currency-unit')
        ){
            $list_type = SelectionList::getListType($type);
            $cached_list = SelectionList::CacheListInSession($list_type);
            return collect($cached_list)
                ->keys()
                ->random(Str::contains($type, 'multiple') ? rand(2, 4) : null);
        } elseif (Str::contains($type, 'rating')){
            $values = [];
            $rating_type = last(explode('-', $type));
            if(Str::contains($rating_type, 'WithNA')){
                $values[] = '-99';
                $rating_type = Str::replace('WithNA', '', $rating_type);
            }
            [$min, $max] = explode('to', $rating_type);
            if(Str::contains($min, 'Minus')){
                $min = Str::replace('Minus', '-', $min);
            }
            $min = intval($min);
            $max = intval($max);
            $values = array_merge($values, range($min, $max));
            return collect($values)->random();
        }

        elseif (Str::contains($type, "selector-species_animal")) {
            $species = Animal::all()->random();
            return $species->phylum
                . '|' . $species->class
                . '|' . $species->order
                . '|' . $species->family
                . '|' . $species->genus
                . '|' . $species->species;
//        elseif ($type==="selector-species_animal_withFreeText"){}

            // IMET

        } elseif (Str::contains($type, "selector-wdpa")){
            if(Str::contains($type, 'multiple')){
                return implode(',', ProtectedArea::all()->random(rand(2,5))->pluck('wdpa_id')->toArray());
            }
            return ProtectedArea::all()->random()->wdpa_id;
        }
//        elseif ($type==="selector-wdpa_multiple_withFreeText"){}

        return null;
    }

    private static function insertRecords($module, $form_id, int $num_records = 1, string $group_key = null): void
    {

        for($y=1; $y<=$num_records; $y++){
            static::insertRecord($module, $form_id, $group_key);
        }
    }

    private static function insertRecord($module, $form_id, string $group_key = null): void
    {
        $values = [
            'FormID' => $form_id,
            'UpdateDate' => now(),
            'UpdateBy' => 0,
        ];

        // Inject predefined values
        $predefined = $module::getPredefined($form_id);
        if($predefined!==null){
            $values[$predefined['field']] =
                $predefined['values']!==null && count($predefined['values']) > 0
                ? (
                Str::contains((new $module)->module_type, 'GROUP')
                    ? collect(collect($predefined['values'])->random())->random()
                    : collect($predefined['values'])->random()
                )
                : null;
        }

        // Generate fake values (fields)
        foreach((new $module)->module_fields as $field){
            if(!array_key_exists($field['name'], $values)){
                $values[$field['name']] = self::getFake($module, $field);
            }
        }

        // Generate fake values (common_fields)
        if((new $module)->module_common_fields!==null) {
            foreach ((new $module)->module_common_fields as $field) {
                if (!array_key_exists($field['name'], $values)) {
                    $values[$field['name']] = self::getFake($module, $field);
                }
            }
        }

        // Add $group_key if required
        if($group_key!==null){
            $values[$module::$group_key_field] = $group_key;
        }

        // IMET: force IncludeInStatistics to true
        if(array_key_exists('IncludeInStatistics', $values)){
            $values['IncludeInStatistics'] = '1';
        }

        $module::insert($values);
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pas = ProtectedArea::all()->random(10);

        Auth::loginUsingId(0);

        for($i=1; $i<=self::NUM_FORMS; $i++){

            $pa = $pas->random();

            $form_id = Imet\v2\Imet::insertGetId([
                'Country' => $pa->country,
                'Year' => fake()->dateTimeBetween('-4 years', 'now')->format('Y'),
                'version' => Imet\v2\Imet::version,
                'language' => collect(['en', 'fr', 'sp', 'pt'])->random(),
                'wdpa_id' => $pa->wdpa_id,
                'name' => $pa->name,
                'UpdateDate' => now(),
                'UpdateBy' => 0,
            ]);

            $modules = array_merge(Imet\v2\Imet::allModules(), Imet\v2\Imet_Eval::allModules());
            foreach ($modules as $module){
                $module_type = (new $module)->module_type;
                $num_records = (Str::contains($module_type, 'TABLE') || Str::contains($module_type, 'ACCORDION'))
                    ? 4
                    : 1;

                if(Str::contains($module_type, 'GROUP')){
                    foreach (collect((new $module)->module_groups)->keys() as $group_key){
                        static::insertRecords($module, $form_id, $num_records, $group_key);
                    }
                } else {
                    static::insertRecords($module, $form_id, $num_records);
                }

            }

        }


    }
}
