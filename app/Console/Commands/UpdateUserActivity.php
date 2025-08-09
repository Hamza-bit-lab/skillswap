<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateUserActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-activity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user activity status based on last activity';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $threshold = Carbon::now()->subDays(15);

        DB::table('users')
            ->where('last_activity', '<', $threshold)
            ->update(['is_active' => false]);

        DB::table('users')
            ->where('last_activity', '>=', $threshold)
            ->update(['is_active' => true]);

        $this->info('User activity statuses updated successfully.');

        return 0;
    }
}
