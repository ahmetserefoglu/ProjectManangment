<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use JeroenNoten\LaravelAdminLte\Events\BuildingMusteri;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            if(Auth::guard()->check()){

                 /*$event->menu->add('Test Bölümü');
            $event->menu->add(
                 [
                'text' => 'Gorevler',
                'url' => 'tasks',
            ],
                 [
                'text' => 'Test',
                'url' => 'testet',
            ],[
                'text' => 'Image Galery',
                'url' => 'image-gallery',
            ],[
                'text' => 'Galery',
                'url' => 'upload-image',
            ],[
                'text' => 'File',
                'url' => 'file',
            ]
            ,[
                'text' => 'Datatable',
                'url' => 'data',
            ]
                );*/
            }
           
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
