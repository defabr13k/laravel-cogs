<?php

namespace DeFabr13k\Cogs\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class DbReset
 *
 * Use:
 * $ php artisan cogs:db:reset
 *
 * @package DeFabr13k\Cogs\Console\Commands
 * @author Olivier Parent <olivier.parent@arteveldehs.be>
 * @copyright Copyright (c) 2017, Olivier Parent & deFABR13K
 */
class DbReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cogs:db:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drops database and runs cogs:db:init';

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

        // Drop database and initialize.
        $this->callSilent('cogs:db:drop');
        $this->callSilent('cogs:db:init');

        $this->comment("Database `${dbName}` reset!");
    }
}
