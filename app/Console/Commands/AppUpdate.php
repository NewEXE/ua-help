<?php

namespace App\Console\Commands;

use App\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Illuminate\Filesystem\Filesystem;

class AppUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update application in production';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $force = $this->hasOption('force') && $this->option('force');

        $this->info("*** Running updates...");

        if ($force) {
            // Clear any local changes in git.
            $process = new Process(['git', 'reset', '--hard']);
            $process->run(function($type, $buffer) {
                $this->info($buffer);
            });
        }

        $process = new Process(['git', 'pull']);

        $alreadyUpToDate = false;
        $process->run(function($type, $buffer) use(&$alreadyUpToDate) {
            if (!$alreadyUpToDate && Str::contains(Str::slug($buffer), 'already-up-to-date')) {
                $alreadyUpToDate = true;
            }
            $this->info($buffer);
        });

        if (!$force && $alreadyUpToDate) {
            $this->info('Exit without updating.');
            return 0;
        }

        if ($force) {
            // Remove Composer's dir.
            $filesystem = new Filesystem();

            $vendorDirPath = base_path() . '/vendor';
            if ($filesystem->isDirectory($vendorDirPath)) {
                $filesystem->deleteDirectory($vendorDirPath);
                $this->info('"vendor" directory is removed.');
            }
        }

        $process = new Process(['composer', 'install', '--classmap-authoritative', '--no-dev']);
        $process->run(function($type, $buffer) {
            $this->info($buffer);
        });

        $process = new Process(['composer', 'clear-cache']);
        $process->run(function($type, $buffer) {
            $this->info($buffer);
        });

        $process = new Process(['composer', 'dump-autoload']);
        $process->run(function($type, $buffer) {
            $this->info($buffer);
        });

        $this->call('optimize:clear');
        $this->call('responsecache:clear');
        $this->call('cache:clear');

        $this->prepareEnvFileForProduction();

        $this->call('config:cache');
        $this->call('view:cache');
        $this->call('event:cache');

        $this->info('*** All done.');

        return 0;
    }

    /**
     * Write a new environment file with the production-ready rules.
     *
     * @return void
     */
    protected function prepareEnvFileForProduction()
    {
        $rules = [
            [
                'envKey' => 'DEBUG',
                'envValue' => 'FALSE',
                'configPath' => 'app.debug',
            ],
            [
                'envKey' => 'APP_ENV',
                'envValue' => 'production',
                'configPath' => 'app.env',
            ],
        ];

        $envFilePath = $this->laravel->environmentFilePath();

        if (!file_exists($envFilePath)) {
            $this->warn('".env" file not exists, nothing to update.');
            return;
        }

        foreach ($rules as $rule) {
            file_put_contents($envFilePath, preg_replace(
                $this->replacementPattern($rule['envKey'], $rule['configPath']),
                $rule['envKey'].'='.$rule['envValue'],
                file_get_contents($envFilePath)
            ));

            $this->laravel['config'][$rule['configPath']] = $rule['envValue'];
        }

        $this->info('".env" file is production-ready for now.');
    }

    /**
     * Get a regex pattern that will match env key with value.
     *
     * @return string
     */
    protected function replacementPattern(string $envKey, string $configPath)
    {
        $escaped = preg_quote('='.$this->laravel['config'][$configPath], '/');

        return "/^$envKey{$escaped}/m";
    }
}
