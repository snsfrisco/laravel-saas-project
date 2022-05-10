<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CompanybaseController extends Controller
{
    public $level_guard = 'company_user';
    public $level_views_dir = 'company_user';
    public $dirpath;
    public $level_route_prefix = 'company_user';
    public $route_prefix;
    public $app_level;

    public function __construct()
    {
        $this->app_level = config('app_level.company');
        $this->dirpath = "{$this->level_views_dir}.{$this->module_dir}.";
        $this->route_prefix = "{$this->level_route_prefix}.{$this->module_route_prefix}.";
        View::share([
            'level_guard' => $this->level_guard,
            'level_views_dir' => $this->level_views_dir,
            'dirpath' => $this->dirpath,
            'level_route_prefix' => $this->level_route_prefix,
            'route_prefix' => $this->route_prefix,
            'app_level' => $this->app_level
        ]);
    }
}
