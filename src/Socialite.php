<?php
namespace Code4mk\KapiSocialite;

use Laravel\Socialite\SocialiteManager;
use Illuminate\Support\Arr;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @since     2019
 * @copyright 0dev.co (https://0dev.co)
 */
 
class Socialite extends SocialiteManager
{
    public function createKapiDriver()
    {
        $config = $this->app['config']['services.kapi'];
        return $this->buildProviderx(KapiProvider::class, $config);
    }

    public function buildProviderx($provider, $config)
    {
      return new $provider(
          $this->app['request'], $config['client_key'],
          $config['client_secret'], $this->formatRedirectUrl($config),
          Arr::get($config, 'guzzle', [])
      );
    }
}
