<?php

namespace Snssystem\LaravelModuleGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Illuminate\Support\Str;

class ModuleViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:moduleviews {viewFile} {moduleName} {model} {modelVariable} {moduleViewsDir} {extendLayout} {routes_prefix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module views';

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
        return base_path('stubs/module.view.'. $this->argument('viewFile') .'.stub');//.'/'.$this-> '../../stubs/module.controller.stub';
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
        $headline = Str::headline($this->argument('moduleName'));
        $singular_headline = Str::headline(Str::pluralStudly($this->argument('model'), 1));

        $routes_prefix = trim($this->argument('routes_prefix'));
        if(!empty($routes_prefix)){
            $routes_prefix .= '.'.$this->argument('moduleName');
        }else{
            $routes_prefix = $this->argument('moduleName');
        }

        return [
            'namespace'         => 'App\\Http\\Controllers',
            'viewFile'          => $this->argument('viewFile'),
            'moduleName'        => $this->argument('moduleName'),
            'headline'          => $headline,
            'singular_headline' => $singular_headline,
            'model'             => $this->argument('model'),
            'modelVariable'     => $this->argument('modelVariable'),
            'moduleViewsDir'    => $this->argument('moduleViewsDir'),
            'extendLayout'      => $this->argument('extendLayout'),
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
        return base_path('resources\\views') . '\\' . str_replace('.', '\\', $this->argument('moduleViewsDir')) . '\\' . $this->argument('viewFile') . '.blade.php';
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
