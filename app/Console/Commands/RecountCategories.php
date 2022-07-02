<?php

namespace App\Console\Commands;

use App\Category;
use Illuminate\Console\Command;

class RecountCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asap:recount:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recounts all threads in a category';

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
        $categories = Category::all();

        foreach ($categories as $category)
        {
            $threadCount = $category->threads->count();

            $category->thread_count = $threadCount;

            $category->save();
        }

        $this->info("Threads Recounted Successfully!");
    }
}
