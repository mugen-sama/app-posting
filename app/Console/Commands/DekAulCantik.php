<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DekAulCantik extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aulia:sayang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test command';

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
     * @return int
     */
    public function handle()
    {
        $this->line('Semangaat yaa sayaangkuu !!! ');
        // return 0;
    }
}
