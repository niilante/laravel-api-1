<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:migration {table} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create migration';

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
        $table = $this->argument('table');
        $model = $this->argument('model');
        $modelCode = $model.'_code';

        Artisan::call('make:migration',['name' =>'create_'.$table]);

        $migrationDirectory = database_path('migrations');
        $migrationFiles = File::files($migrationDirectory);

        $createdFile = null;

        foreach ($migrationFiles as $file){
            $fileName = $file->getFilename();
            if(preg_match('@(.*)_create_'.$table.'\.php@',$fileName,$catch)){
                $createdFile = $catch[0] ?? null;
            }
        }

        $createdFilePath = $migrationDirectory.''.DIRECTORY_SEPARATOR.''.$createdFile;

        $content = File::get($createdFilePath);
        $content = str_replace('$table->id();','$table->id();
            $table->bigInteger(\''.$modelCode.'\')->default(0)->unique()->index();

            $table->boolean(\'status\')->default(1);
            $table->boolean(\'is_deleted\')->default(0);
            $table->bigInteger(\'created_by\')->default(0);
            $table->bigInteger(\'updated_by\')->default(0);
            $table->bigInteger(\'deleted_by\')->default(0);
            $table->index([\'status\',\'is_deleted\']);
            $table->timestamp(\'deleted_at\')->nullable();',$content);

        File::put($createdFilePath,$content);

        $this->warn('migration has been successful created');
        return 0;
    }
}
