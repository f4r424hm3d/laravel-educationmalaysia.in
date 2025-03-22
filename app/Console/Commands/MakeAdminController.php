<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeAdminController extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:admincontroller {name}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new admin controller with predefined code';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $name = $this->argument('name');
    $directory = app_path('Http/Controllers/admin');
    $filePath = $directory . '/' . $name . 'C.php';

    // Ensure the directory exists
    if (!File::exists($directory)) {
      File::makeDirectory($directory, 0755, true);
    }

    // Check if the file already exists
    if (File::exists($filePath)) {
      $this->error("Controller already exists!");
      return Command::FAILURE;
    }

    // Controller Template
    $template = <<<PHP
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class {$name}C extends Controller
{

}
PHP;

    // Create the controller file
    File::put($filePath, $template);
    $this->info("Admin controller {$name}C created successfully!");

    return Command::SUCCESS;
  }
}
