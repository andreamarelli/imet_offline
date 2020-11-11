<?php

namespace App\Console\Commands;

use App\Library\Utils\File\File;
use App\Models\Country;
use App\Models\Imet\Utils\ProtectedArea;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ProtectedPlanetCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retrieve:protected_planet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve protected areas from Protected Planet CSV and generate a SQL INSERT file';


    public const protected_planet_csv = 'WDPA_Nov2019-csv.csv';

    private $sql_file;
    private $countries;
    private $all_count = 0;
    private $found_count = 0;
    private $csv_path = null;
    private $sql_path = null;
    private $storage = null;
    private $already_parsed = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->storage = \Storage::disk(File::PRIVATE_STORAGE);
        $this->sql_file = self::protected_planet_csv.'.sql';
        $this->csv_path = $this->storage->path(self::protected_planet_csv);
        $this->sql_path = $this->storage->path($this->sql_file);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // check if file exists
        try{
            if(!$this->storage->exists(self::protected_planet_csv)){
                throw new FileNotFoundException();
            }
        } catch (FileNotFoundException $e){
            $this->error('Protected Planet CSV file not found in: '.$this->storage->path(''));
            return 0;
        }

        // delete existing sql file
        if($this->storage->exists($this->sql_file)){
            $this->storage->delete($this->sql_file);
        }

        // retrieve countries
        $this->retrieve_countries();

        // initialize files
        $csv_file = fopen($this->csv_path, 'r');
        $sql_file =  fopen($this->sql_path, 'a');
        fwrite($sql_file,'BEGIN;'.PHP_EOL.PHP_EOL);

        // parse Protected Planet CSV and write SQL
        fgetcsv($csv_file);
        while (($line = fgetcsv($csv_file)) !== FALSE) {
            $this->all_count++;
            $sql_row = $this->parse_csv_row($line);
            if($sql_row!==null){
                $this->found_count++;
                fwrite($sql_file,$sql_row.PHP_EOL);
            }
        }

        // close files
        fwrite($sql_file,PHP_EOL.'COMMIT;'.PHP_EOL);
        fclose($csv_file);
        fclose($sql_file);

        // write output
        $this->info('Total protected areas in CSV: ' .$this->all_count);
        $this->info('BIOPAMA protected areas extracted: ' .$this->found_count);
        $this->info('File saved in : ' .$this->sql_path);

        return 0;
    }

    /**
     * Retrieve BIOPAMA countries (from IMET table)
     */
    private function retrieve_countries()
    {
        $country = new Country();
        $this->countries = $country
            ->forceImetTable()
            ->notOfac()
            ->get()
            ->pluck('iso3')
            ->toArray();
    }

    /**
     * Parse a CSV row and return the SQL insert statement
     * @param $row
     * @return string|null
     */
    private function parse_csv_row($row)
    {
        $country  = $row[28];
        if(in_array($country, array_values($this->countries))){
            $wdpa_id =  $row[1];
            $global_id = $this->get_global_id('xxx_', $wdpa_id);

            $pa = new ProtectedArea();
            $pa->country = $country;
            $pa->wdpa_id = $row[1];
            $pa->global_id = $global_id;
            $pa->name = $row[4];
            $pa->iucn_category = $row[9];
            return $pa->rawQueryToImet();
        }
        return null;
    }

    private function get_global_id($region, $wdpa_id)
    {
        $global_id =  $region.'_'.$wdpa_id;
        $i = 2;
        while(in_array($global_id, $this->already_parsed)){
            $global_id = $global_id.'-'.$i;
            $i++;
        }
        $this->already_parsed[] = $global_id;
        return $global_id;
    }
}
