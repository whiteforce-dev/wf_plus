<?php

namespace App\Console\Commands;

use App\Http\Controllers\CandidateResponseController;
use Illuminate\Console\Command;

class GetShineJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getshinejob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $shine_job = (new CandidateResponseController())->getresponseshine();
            \Log::info('Shine job data retrieved successfully');
        } catch (\Exception $e) {
            \Log::error('Error while retrieving Shine job data: ' . $e->getMessage());
            return 0;
        }
        return 1;
    }
}
