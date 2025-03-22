<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeCustomImport extends Command
{
  protected $signature = 'make:customImport {name}'; // Custom command
  protected $description = 'Create a custom Excel import class dynamically';

  public function handle()
  {
    $name = ucfirst($this->argument('name')); // Ensure first letter is capitalized
    $modelName = str_replace('Import', '', $name); // Remove 'Import' if included
    $filePath = app_path("Imports/{$name}.php");

    $stub = $this->getStub();
    $stub = str_replace('{{className}}', $name, $stub);
    $stub = str_replace('{{modelName}}', $modelName, $stub);

    $filesystem = new Filesystem();
    if (!$filesystem->isDirectory(app_path('Imports'))) {
      $filesystem->makeDirectory(app_path('Imports'), 0777, true);
    }

    if ($filesystem->exists($filePath)) {
      $this->error("Import file {$name}.php already exists!");
      return;
    }

    $filesystem->put($filePath, $stub);
    $this->info("Import file {$name}.php created successfully.");
  }

  protected function getStub()
  {
    return <<<'STUB'
<?php

namespace App\Imports;

use App\Models\{{modelName}};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class {{className}} implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        $rowsInserted = 0;
        $totalRows = 0;

        foreach ($rows as $row) {
            $where = ['col1' => $row['col1']];
            $data = {{modelName}}::where($where)->count();

            if ($data == 0) {
                {{modelName}}::create([
                    'col1' => $row['col1'],
                ]);
                $rowsInserted++;
            }

            $totalRows++;
        }

        if ($rowsInserted > 0) {
            session()->flash('smsg', "$rowsInserted out of $totalRows rows imported successfully.");
        } else {
            session()->flash('emsg', 'Data not imported. Duplicate rows found.');
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
STUB;
  }
}
