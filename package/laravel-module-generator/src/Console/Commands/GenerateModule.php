<?php

namespace Snssystem\LaravelModuleGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\BufferedOutput;

class GenerateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Module with Controller, Model, Migration and View files';

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
        $output = new BufferedOutput();
        $moduleName = trim($this->ask('Module (in plural form)?'));
        if(empty($moduleName)){
            $this->error('Module name is required!');
            return 0;
        }
        $moduleName = strtolower($moduleName);
        $this->line("Module :{$moduleName}");
        $controller_name = $this->ask('Controller Name (with or without directory name like Dirname/DummyController)');
        $model = $this->ask('Model Name (use singluar form and pascal case like ModelName)');
        $modelVariable = Str::snake($model);
        $storeRequest = $model."StoreRequest";
        $updateRequest = $model."UpdateRequest";
        $moduleViewsDir = $this->ask('Module views files directory path inside views folder(eg. admin/users):');
        $moduleViewsDir = str_replace('/', '.', $moduleViewsDir);
        /* dd([
            'name' => $controller_name,
            'moduleName' => $moduleName,
            'model' => $model,
            'modelVariable' => $modelVariable,
            'storeRequest' => $storeRequest,
            'updateRequest' => $updateRequest,
            'moduleViewsDir' => $moduleViewsDir,
        ]); */

        // create controller
            if(empty($controller_name)){
                $this->error('Controller Name is required to create a controller.');
            }else{
                $this->call(
                    'make:modulecontroller',
                    [
                        'name' => $controller_name,
                        'moduleName' => $moduleName,
                        'model' => $model,
                        'modelVariable' => $modelVariable,
                        'storeRequest' => $storeRequest,
                        'updateRequest' => $updateRequest,
                        'moduleViewsDir' => $moduleViewsDir,
                    ],
                    $output
                );
            }

        // create views
            if(empty($moduleViewsDir)){
                $this->error('Module views files directory is required to create view files.');
            }else{
                $view_files_arr = ['index', 'create', 'edit', '_action', '_form', '_common_js', '_active_cb'];
                foreach ($view_files_arr as $viewFile) {
                    $this->call(
                        'make:moduleviews',
                        [
                            'viewFile'          => $viewFile,
                            'moduleName'        => $moduleName,
                            'model'             => $model,
                            'modelVariable'     => $modelVariable,
                            'moduleViewsDir'    => $moduleViewsDir,
                        ],
                        $output
                    );
                }
            }

        // create Request classes
            if(empty($model)){
                $this->error('Model Name is required to create request files.');
            }else{
                foreach ([ $storeRequest, $updateRequest ] as $requestName) {
                    $this->call(
                        'make:request',
                        [
                            'name' => $requestName
                        ],
                        $output
                    );
                }
            }

        // create model
            if(empty($model)){
                $this->error('Model Name is required to create Model and migration files.');
            }else{
                $this->call(
                    'make:model',
                    [
                        'name' => $model,
                        '-m' => true
                    ],
                    $output
                );
            }

        // Routes
            dump("=========== Module Route =========");
            dump("use App\Http\Controllers\{$controller_name}");
            dump("Route::resource('{$moduleName}', {$controller_name}::class)");


        // $this->newLine(3);
        // $this->error('Something went wrong!');
        // $this->info('The command was successful!');
        // $defaultIndex = 0;
        // $name = $this->choice(
        //     'What is your name?',
        //     ['Taylor', 'Dayle'],
        //     $defaultIndex,
        //     $maxAttempts = null,
        //     $allowMultipleSelections = false
        // );
        // $this->info('The name:' . $name);


        // // $clientid = $output->fetch(); */

        return 0;
    }
}
