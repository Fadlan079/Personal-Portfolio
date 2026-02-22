<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class AutoForceDeleteTrashedProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-force-delete-trashed-projects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = Project::onlyTrashed()
            ->where('deleted_at', '<=', now()->subDays(30))
            ->forceDelete();

        $this->info('Deleted: ' . $deleted);
    }
    }
