<?php

namespace DeFabr13k\Cogs\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class DbUser
 *
 * Use:
 * $ php artisan cogs:db:user
 *
 * @package DeFabr13k\Cogs\Console\Commands
 * @author Olivier Parent <olivier.parent@arteveldehs.be>
 * @copyright Copyright (c) 2017, Olivier Parent & deFABR13K
 */
class DbUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cogs:db:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a database user as specified in the configuration';

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
        $dbAdminName = env('DB_ADMIN_USERNAME');
        $dbAdminPassword = env('DB_ADMIN_PASSWORD');

        $sql ="GRANT ALL PRIVILEGES ON \`${dbName}\`.* TO '${dbUsername}' IDENTIFIED BY '${dbPassword}'";
        if (windows_os()) {
            $sql = str_replace('\`', '`', $sql);
        }
        $command = sprintf('mysql --user=%s --password=%s --execute="%s"', $dbAdminName, $dbAdminPassword, $sql);
        exec($command);

        $this->comment("Database user `${dbUsername}` created!");
    }
}
