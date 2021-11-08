<?php

namespace AndreaMarelli\ImetCore\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


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
     * @return int
     */
    public function handle(): int
    {
        try {
            $model = DB::table('imet.offline_serial_number')
                ->select('serial_number')
                ->first();
            $this->info($model ? $model->serial_number : null);
            return 0;
        } catch (Exception $e){
            $this->error('ERROR');
            return 1;
        }
    }

}
