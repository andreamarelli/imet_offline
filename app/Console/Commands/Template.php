<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class Template extends Command
{

    protected $signature = 'imet:template_command';

    protected $description = 'Empty template to be used for executing temporary commands';

    public function handle(): int
    {

        return 0;
    }

}
