<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function loadDefaultDataToView($view_path)
    {
        View::composer($view_path, function($view) {
            $view->with('base_route', $this->base_route);
            $view->with('view', $this->view);
            $view->with('panel', $this->panel);
            $view->with('folder', isset($this->folder) ? $this->folder : '');
        });

        return $view_path;
    }
}
