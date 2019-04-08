<?php

namespace Code4mk\KapiSocialite;

use Laravel\Socialite\SocialiteServiceProvider;
use Code4mk\KapiSocialite\Socialite;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @since     2019
 * @copyright 0dev.co (https://0dev.co)
 */

class KapiSocialiteServiceProvider extends SocialiteServiceProvider
{
    public function register()
    {
        $this->app->singleton('Laravel\Socialite\Contracts\Factory', function ($app) {
            return new Socialite($app);
        });
    }
}
