<?php

namespace App\Providers;

use Illuminate\Support\Facades\{Cache, DB};
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('countryList', function ($app) {
            return Cache::store('redis')->rememberForever('countries', function () {
                return DB::table('countries')
                    ->select('id AS value', 'name_en AS text_en', 'name_bn  AS text_bn', 'status')
                    ->orderBy('name_en')
                    ->get();
            });
        });

        $this->app->singleton('postList', function ($app) {
            return Cache::store('redis')->rememberForever('posts', function () {
                return DB::table('posts')
                    ->select('id AS value', 'title_en AS text_en', 'title_bn  AS text_bn', 'status')
                    ->orderBy('title_en')
                    ->get();
            });
        });
    }
}
