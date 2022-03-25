<?php

namespace App\Console\Commands;

use App\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class AppUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update';

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
        $this->info("Running updates...");

        $process = new Process(['git', 'pull']);

        $alreadyUpToDate = false;
        $process->run(function($type, $buffer) use(&$alreadyUpToDate) {
            if (Str::contains($buffer, 'Already up to date')) {
                $alreadyUpToDate = true;
            }
            $this->info($buffer);
        });

        if ($alreadyUpToDate) {
            return true;
        }

        $process = new Process(['composer', 'install', '--optimize-autoloader', '--no-dev']);
        $process->run(function($type, $buffer) {
            if ($type === Process::ERR) {
                $this->error($buffer);
            } else {
                $this->info($buffer);
            }
        });

        $this->call('config:cache');
        $this->call('view:cache');

        $this->prepareEnvFileForProduction();

        $this->info('All done');

        return $process->isSuccessful();
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
