<?php

namespace App\Console\Commands\Imet;

use Illuminate\Console\Command;

class GetSerialNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:get_serial_number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve IMET offline unique Serial Number from database';

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
        try {
            $model = \DB::table('imet.offline_serial_number')
                ->select('serial_number')
                ->first();
            $this->info($model ? $model->serial_number : null);
            return 0;
        } catch (\Exception $e){
            $this->error('ERROR');
            $this->error($e);
            return 1;
        }
    }

}
