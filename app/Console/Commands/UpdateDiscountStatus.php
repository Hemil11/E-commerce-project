<?php

namespace App\Console\Commands;

use App\Models\discount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateDiscountStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:discountStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update discount status based on start_date and end_date.';

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
        try {
            $today = now()->timezone('Asia/Kolkata');
            Log::info("Running update:discountStatus command at " . $today);

            Discount::where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)
                ->update(['is_active' => 1]);

            Discount::where('end_date', '<=', $today)
                ->update(['is_active' => 0]);

            $this->info('Discount status updated successfully.');
        } catch (\Exception $e) {
            Log::error("Error in update:discountStatus command: " . $e->getMessage());
            $this->error('An error occurred while updating discount status.');
        }
    }

}
