<?php

namespace App\Providers;

use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('components.navs.backend-nav', function (View $view) {
            [$controller, $action] = explode('@', class_basename(\Route::getCurrentRoute()->action['controller']));

            return $view->with(compact('controller', 'action'));
        });
    }
}
