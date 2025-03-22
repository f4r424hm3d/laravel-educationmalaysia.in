<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  protected $commands = [
    \App\Console\Commands\MakeAdminView::class, // Register your custom command here
    \App\Console\Commands\MakeFrontView::class,
    \App\Console\Commands\MakeAdminController::class,
    \App\Console\Commands\MakeCustomImport::class,
  ];

  /**
   * Register the commands for the application.
   *
   * @return void
   */
  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');

    require base_path('routes/console.php');
  }

  /**
   * Define the application's command schedule.
   *
   * @param \Illuminate\Console\Scheduling\Schedule $schedule
   * @return void
   */
  protected function schedule(Schedule $schedule)
  {
    // Define scheduled tasks here
  }
}
