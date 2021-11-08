<?php

namespace AndreaMarelli\ImetCore\Commands;


trait Utils{

    private function dispatch($item, $args=null){
        $time_start  = microtime(true);
        $this->info('Executing '.$item);
        $item::dispatch($args);
        $this->info('Finished in '.round((microtime(true) - $time_start), 2).' seconds');
    }

}
