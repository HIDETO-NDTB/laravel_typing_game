<?php

namespace App\Providers;

use App\Http\ViewComposers\UserComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            UserComposer::class => 'layouts.*'
        ]);
    }
}
