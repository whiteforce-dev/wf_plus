<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CandidateController;

class CloneOldOffroleCandidate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clone:oldOffroleCandidate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cloning Candidate From Old Offrole Project';

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
        \Log::info('Offrole:Started');
        $api = new CandidateController();
        $result = $api->cloneOffroleCandidateData();
        \Log::info('Offrole:Result- '.$result);
    }
}
