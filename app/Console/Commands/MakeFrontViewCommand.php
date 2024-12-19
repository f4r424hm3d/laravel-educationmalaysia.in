<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeFrontViewCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:front-view {name}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new view file with default boilerplate code in the front folder';

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
    $path = resource_path("views/front/{$name}.blade.php");

    // Check if the file already exists
    if (File::exists($path)) {
      $this->error("The view {$name} already exists at {$path}!");
      return 1;
    }

    // Ensure the directory exists
    File::ensureDirectoryExists(dirname($path));

    // Default boilerplate content
    $content = <<<EOT
@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
@endsection
EOT;

    // Create the file with the boilerplate content
    File::put($path, $content);

    $this->info("View {$name} created successfully at resources/views/front/{$name}.blade.php");
    return 0;
  }
}
