<?php

namespace App\Console\Commands;

use App\Http\Controllers\NewJobPostingController;
use Illuminate\Console\Command;

class GetJobjobjobJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getjobjobjob';

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
            $shine_job = (new NewJobPostingController())->getJobjobjob();
            \Log::info('Job job data retrieved successfully');
        } catch (\Exception $e) {
            \Log::error('Error while retrieving Muse Job data: ' . $e->getMessage());
            return 0;
        }
        return 1;
    }
}
