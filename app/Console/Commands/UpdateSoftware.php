<?php

namespace App\Console\Commands;

use App\Support\SoftwareUpdater\Db1000n\Db1000nUpdater;
use App\Support\SoftwareUpdater\UaCyberShield\UaCyberShieldUpdater;
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
    protected $description = 'Update DDoS software copies on the server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new Db1000nUpdater())->update();
        (new UaCyberShieldUpdater())->update();
        $this->info('Update software done.');
        return 0;
    }
}
