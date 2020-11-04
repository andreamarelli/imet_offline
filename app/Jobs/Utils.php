<?php

namespace App\Jobs;

use Symfony\Component\Console\Output\ConsoleOutput;

trait Utils {

    private static function log($message, $type='comment')
    {
        if(is_array($message) || is_object($message)){
            $message = print_r($message, true);
        }

        $output = new ConsoleOutput();
        if($type=='info'){
            $output->writeln("<info>".$message."</info>");
        } elseif($type=='comment'){
            $output->writeln("<comment>".$message."</comment>");
        } elseif($type=='error'){
            $output->writeln("<error>".$message."</error>");
        } elseif($type==null){
            $output->writeln($message);
        }
    }

}