<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitSystemCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:init 
                            {--S|sample-data : Generate sample data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial set-up of the system';

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
     * @return void
     */
    public function handle()
    {
        $this->info('System initialization has been started!');
        $this->info('Starting migration...');

        $exitMigrateCommandCode = Artisan::call('migrate:refresh');

        if ($exitMigrateCommandCode !== 0) {
            $this->error('Error during \'migrate\' command. Error code: ' . $exitMigrateCommandCode);
            return;
        }

        $this->info('Migration is successfully passed.');
        $this->info('Starting seeding...');

        $exitSeedCommandCode = Artisan::call('db:seed');

        if ($exitSeedCommandCode !== 0) {
            $this->error('Error during \'db:seed\' command. Error code: ' . $exitSeedCommandCode);
            return;
        }

        $this->info('Seeding is successfully passed.');
        $this->info('Starting set-up of Admin account...');

        $exitCreateAdminAccountSeedCommandCode = Artisan::call('db:seed', [
            '--class' => 'CreateAdminAccountSeeder',
        ]);

        if ($exitCreateAdminAccountSeedCommandCode !== 0) {
            $this->error('Error during set-up of Admin account. Error code: '
                . $exitCreateAdminAccountSeedCommandCode);
            return;
        }

        $this->info('Set-up of Admin account was successfully passed.');
        $needImportSampleData = $this->option('sample-data');

        if ($needImportSampleData) {
            $this->info('Starting import sample data...');

            $exitGenerateTestFormsSeedCommandCode = Artisan::call('db:seed', [
                '--class' => 'GenerateTestFormsSeeder',
            ]);
            
            if ($exitGenerateTestFormsSeedCommandCode !== 0) {
                $this->error('Error during generation test forms. Error code: '
                    . $exitGenerateTestFormsSeedCommandCode);
                return;
            }

            $this->info('Import of sample data successfully finished.');
        }

        $this->info('System initialization is successfully finished.');
    }
}
