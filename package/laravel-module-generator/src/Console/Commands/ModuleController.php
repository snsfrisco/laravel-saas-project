<?php

namespace Snssystem\LaravelModuleGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Illuminate\Support\Str;

class ModuleController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature  = 'make:modulecontroller {name} {moduleName} {model} {modelVariable} {modelVariable_plural} {storeRequest} {updateRequest} {moduleViewsDir} {routes_prefix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module controller';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        return base_path('stubs/module.controller.stub');//.'/'.$this-> '../../stubs/module.controller.stub';
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getStubVariables()
    {
        $namespace = 'App\\Http\\Controllers';
        $class_name = $this->argument('name');
        if(Str::contains($class_name, '/')){
            $class_name = Str::afterLast($class_name, '/');
            $string_before_controller_name = Str::beforeLast($this->argument('name'), '/'.$class_name);
            $string_before_controller_name = Str::replace('/', '\\', $string_before_controller_name);
            $namespace = $namespace.'\\'.$string_before_controller_name;
        }

        $routes_prefix = trim($this->argument('routes_prefix'));
        if(!empty($routes_prefix)){
            $routes_prefix .= '.'.$this->argument('moduleName');
        }else{
            $routes_prefix = $this->argument('moduleName');
        }

        return [
            'namespace'         => $namespace,
            'class_name'        => $class_name,
            'moduleName'        => $this->argument('moduleName'),
            'model'             => $this->argument('model'),
            'modelVariable'     => $this->argument('modelVariable'),
            'modelVariable_plural' => $this->argument('modelVariable_plural'),
            'storeRequest'      => $this->argument('storeRequest'),
            'updateRequest'     => $this->argument('updateRequest'),
            'moduleViewsDir'    => $this->argument('moduleViewsDir'),
            'routes_prefix'     => $routes_prefix
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }
        // dump($stub, $stubVariables,$contents);

        return $contents;
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        return base_path('App\\Http\\Controllers') . '\\' . $this->argument('name') . '.php';
    }

    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
