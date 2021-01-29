<?php

namespace App\Console\Commands\Imet;

use Illuminate\Console\Command;

class SetSerialNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:set_serial_number {serial_number?} {--force-delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store into database the IMET offline unique Serial Number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $serial_number = $this->argument('serial_number');
        $force_delete = $this->option('force-delete');

        if($force_delete){
            \DB::insert('delete from imet.offline_serial_number');
            $this->warn('Serial Number removed.');
            return 0;
        }

        if($serial_number !== null){
            // write to DB only if table is empty. could be written only ONCE
            if(\DB::table('imet.offline_serial_number')->select('serial_number')->first() == null){
                \DB::insert('insert into imet.offline_serial_number (serial_number) values (?)', [$serial_number]);
                $this->info('Serial Number written to DB.');
            } else {
                $this->warn('Serial Number already exists.');
            }
        } else {
            $this->warn('Serial Number not provided.');
        }


        return 0;





        return 0;
    }

}
