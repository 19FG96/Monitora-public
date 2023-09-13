<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostsModel;
use Carbon\Carbon;

class UpdatePostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-posts-command {--yesterday : Update posts from yesterday}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all posts from API and Add or Update data in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $postsModel = new PostsModel();

        $updateFromYesterday = $this->option('yesterday');
        $dateFrom = Carbon::yesterday()->format('Y-m-d\TH:i:s\Z');

        if ($updateFromYesterday) {
            $postsModel->saveOrUpdate($dateFrom);
            \Log::info("saveOrUpdate function returned posts from yesterday only.");
        } else {
            $postsModel->saveOrUpdate('2000-06-01T00:00:00Z');
            \Log::info("saveOrUpdate function returned all posts available on API (since 01.06.2000)");
        }
    }
}

