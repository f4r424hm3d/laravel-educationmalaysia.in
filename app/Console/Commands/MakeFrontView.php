<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeFrontView extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:front-view {file}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new front view file with default content';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $fileName = $this->argument('file');
    $filePath = resource_path("views/front/{$fileName}.blade.php");

    if (File::exists($filePath)) {
      $this->error("The view file already exists at: {$filePath}");
      return 1;
    }

    $defaultContent = <<<'EOT'
@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
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
