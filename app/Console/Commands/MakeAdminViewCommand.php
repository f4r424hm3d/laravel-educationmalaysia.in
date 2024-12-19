<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeAdminViewCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:admin-view {name}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new admin view file with default boilerplate code';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    // Get the view name from the command argument
    $name = $this->argument('name');

    // Define the path to the view file
    $path = resource_path("views/admin/{$name}.blade.php");

    // Check if the file already exists
    if (File::exists($path)) {
      $this->error("The view {$name} already exists at {$path}!");
      return 1;
    }

    // Ensure the directory exists
    File::ensureDirectoryExists(dirname($path));

    // Default boilerplate content
    $content = <<<EOT
@extends('admin.layouts.main')
@push('title')
<title>{{ \$page_title }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
@endsection
EOT;

    // Create the file with the boilerplate content
    File::put($path, $content);

    $this->info("Admin view {$name} created successfully at resources/views/admin/{$name}.blade.php");
    return 0;
  }
}
