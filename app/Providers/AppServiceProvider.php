<?php

namespace App\Providers;

use App\Repository\AttributeRepository;
use App\Repository\Interfaces\AttributeRepositoryInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\Repository\ProductRepository;
use App\UseCases\Product\ParserCollection;
use App\UseCases\Product\ProductParserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(ProductParserService::class, function (Application $app) {
            $patterns    = $app->make('config')->get('parser');
            $collections = new ParserCollection();
            foreach ($patterns as $pattern) {
                $collections->add($pattern['name'], $pattern['pattern'], $pattern['tokens']);
            }

            return new ProductParserService($collections);
        });

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }
}
