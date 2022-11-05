<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SalesAudit;
use App\Models\Warehouse;
use App\Models\Sales;
use App\Models\Retail;
use Session;
use Carbon\Carbon;
use Log;


class EndStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:end_stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        return 0;
    }
}
