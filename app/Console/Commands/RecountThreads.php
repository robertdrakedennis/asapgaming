<?php

namespace App\Console\Commands;

use App\Thread;
use Illuminate\Console\Command;

class RecountThreads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asap:recount:replies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recounts all the replies in a thread.';

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
        $threads = Thread::all();

        foreach ($threads as $thread)
        {
            $replyCount = $thread->replies->count();

            $thread->reply_count = $replyCount;
        }
        $this->info("Threads Recounted Successfully!");
    }
}
