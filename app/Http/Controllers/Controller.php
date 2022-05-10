<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function mv($file, $compact = null)
    {
        $view = view("{$this->level_views_dir}.{$this->module_dir}.{$file}");
        if($compact){
            $view->with($compact);
        }
        return $view;
    }
}
