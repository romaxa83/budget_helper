<?php

namespace App\Console\Commands\Init;

use Illuminate\Console\Command;

class Init extends Command
{
    protected $signature = 'cmd:init';

    protected $description = 'Init data for app';

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->call('cmd:create-admin');
    }

}
