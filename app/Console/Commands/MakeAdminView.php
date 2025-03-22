<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeAdminView extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:admin-view {file}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new admin view file with default content';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $fileName = $this->argument('file');
    $filePath = resource_path("views/admin/{$fileName}.blade.php");

    if (File::exists($filePath)) {
      $this->error("The view file already exists at: {$filePath}");
      return 1;
    }

    $defaultContent = <<<'EOT'
@extends('admin.layouts.main')
@push('title')
<title>{{ $page_title }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
@endsection
EOT;

    File::ensureDirectoryExists(dirname($filePath));

    File::put($filePath, $defaultContent);

    $this->info("Admin view file created successfully at: {$filePath}");
    return 0;
  }
}
