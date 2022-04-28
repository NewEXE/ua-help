<?php

namespace App\Console\Commands;

use App\Support\FileUpdater\Db1000nUpdater;
use Illuminate\Console\Command;

class UpdateSoftware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:software';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $u = new Db1000nUpdater();
        $u->update();
        return 0;
    }
}
