<?php

namespace Code4mk\KapiSocialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use Config;
use Illuminate\Http\Request;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @since     2019
 * @copyright 0dev.co (https://0dev.co)
 */

class KapiProvider extends AbstractProvider implements ProviderInterface
{
    // protected $fields = [
    //     'id', 'username', 'url', 'first_name', 'last_name', 'bio', 'image'
    // ];

    /**
     * Get the authentication URL for the provider.
     *
     * @param  string $state
     * @return string
     */
    protected function getAuthUrl($state)
    {

        return $this->buildAuthUrlFromBase(Config::get('kapisocialite.authorize_uri'), $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return Config::get('kapisocialite.token_uri') . '?' . http_build_query([
            'grant_type' => 'authorization_code',
        ]);
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string $token
     * @return array
     */
    public function getUserByToken($token='token')
    {
        $url = Config::get('kapisocialite.token_uri');

        $response = $this->getHttpClient()->get($url, [
            'query' => [
                'token' => \Request::get($token),
                'osecret' => Config::get('services.kapi.osecret')
            ],
        ]);

        return json_decode($response->getBody(), true);

        //return json_decode($response->getBody(), true);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array $user
     * @return \Laravel\Socialite\User
     */
    protected function mapUserToObject(array $user)
    {
        $user = $user['data'];

        return (new User)->setRaw($user)->map([
            'id' => $user['id'],
            'nickname' => $user['username'],
            'name' => $user['first_name'] . ' ' . $user['last_name'],
            'email' => 'k@gmail.com',
            'avatar' => $user['image']['60x60']['url'],
            'avatar_original' => null,
        ]);
    }

    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }

    protected function getCodeFields($state = null)
    {
        $fields = [
            'client_key' => $this->clientId,
            'client_secret' => $this->clientSecret
        ];
        return $fields;
    }
}
