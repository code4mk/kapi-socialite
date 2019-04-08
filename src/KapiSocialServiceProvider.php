<?php

namespace Code4mk\KapiSocialite;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @since     2019
 * @copyright 0dev.co (https://0dev.co)
 */

class KapiSocialServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
   public function boot()
   {
      // publish config
       $this->publishes([
        __DIR__ . '/../config/kapisocialite.php' => config_path('kapisocialite.php')
       ], 'config');
   }

  /**
   * Register any application services.
   *
   * @return void
   */
   public function register()
   {

   }
}
