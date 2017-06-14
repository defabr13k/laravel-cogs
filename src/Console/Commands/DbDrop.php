<?php

namespace DeFabr13k\Cogs\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class DbDrop
 *
 * Use:
 * $ php artisan cogs:db:drop
 *
 * @package DeFabr13k\Cogs\Console\Commands
 * @author Olivier Parent <olivier.parent@arteveldehs.be>
 * @copyright Copyright (c) 2017, Olivier Parent & deFABR13K
 */
class DbDrop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cogs:db:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drops database';

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
        // Get variables from `.env`
        $dbName = env('DB_DATABASE');
        $dbUsername = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Drop database
        $sql = "DROP DATABASE IF EXISTS \`${dbName}\`";
        if (windows_os()) {
            $sql = str_replace('\`', '`', $sql);
        }

        $command = sprintf('mysql --user=%s --password=%s --execute="%s"', $dbUsername, $dbPassword, $sql);
        exec($command);

        $this->comment("Database `${dbName}` dropped!");
    }
}
