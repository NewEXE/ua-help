<?php

namespace App\Console\Commands;

use App\Support\SoftwareUpdater\FileUpdaterException;
use App\Support\SoftwareUpdater\UaCyberShield;
use App\Support\SoftwareUpdater\Db1000n;
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
    protected $description = 'Update DDoS software copies on the public storage';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws FileUpdaterException
     */
    public function handle()
    {
        $this->info('Start update software...');

        (new Db1000n\Win64Updater())->update();
        $this->info('db1000n x64 updated');

        (new Db1000n\Win32Updater())->update();
        $this->info('db1000n x32 updated');

        (new UaCyberShield\WinUpdater())->update();
        $this->info('UA Cyber SHIELD updated');

        $this->info('...done');

        return 0;
    }
}
