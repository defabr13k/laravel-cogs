<?php

namespace DeFabr13k\Cogs\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class DbInit
 *
 * Use:
 * $ php artisan cogs:db:init
 *
 * @package DeFabr13k\Cogs\Console\Commands
 * @author Olivier Parent <olivier.parent@arteveldehs.be>
 * @copyright Copyright (c) 2017, Olivier Parent & deFABR13K
 */
class DbInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cogs:db:init {--seed : Run migrations and seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates database user and database, and executes migrations';

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
     * @return mixed
     */
    public function handle()
    {
        // Get variables from `.env`.
        $dbName = env('DB_DATABASE');
        $dbUsername = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Create database user and drop database if it already exists.
        $this->callSilent('cogs:db:user');
        $this->callSilent('cogs:db:drop');

        // Create database.
        $sql = "CREATE DATABASE IF NOT EXISTS \`${dbName}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if (windows_os()) {
            $sql = str_replace('\`', '`', $sql);
        }
        $command = sprintf('mysql --user=%s --password=%s --execute="%s"', $dbUsername, $dbPassword, $sql);
        exec($command);

        // Run migrations.
        if ($this->option('seed')) {
            $this->call('migrate', [
                '--seed' => true,
            ]);
        }

        $this->comment("Database `${dbName}` initialized!");
    }
}
