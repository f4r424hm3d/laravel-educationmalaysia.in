<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateCrud extends Command
{
  protected $signature = 'generate:crud {name}';
  protected $description = 'Generate model, controller, and view dynamically';

  public function handle()
  {
    $name = $this->argument('name'); // Get the dynamic model name
    $pluralName = Str::plural(Str::snake($name, '-')); // Convert to kebab-case plural

    $this->call('make:model', ['name' => $name, '--migration' => true]);
    $this->call('make:AdminController', ['name' => $name]);

    // Fix: Pass 'file' argument instead of 'name' to match MakeAdminView command
    $this->call('make:admin-view', ['file' => $pluralName]);

    $this->info("CRUD files for {$name} generated successfully!");
  }
}
