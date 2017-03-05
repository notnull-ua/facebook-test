<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 03.03.2017
 * Time: 15:21
 */

namespace components;


class Facebook extends AbstractService
{
    public function __construct($config)
    {
        parent::__construct($config);
        $this->socialFieldsMap = [
            'socialId' => 'id',
            'email' => 'email',
            'name' => 'name',
            'socialPage' => 'link',
            'sex' => 'gender',
            'birthday' => 'birthday'
        ];
        $this->provider = 'facebook';
    }

    /**
     * Get url of user's avatar or null if it is not set
     *
     * @return string|null
     */
    public function getAvatar()
    {
        $result = null;
        if (isset($this->userInfo['username'])) {
            $result = 'http://graph.facebook.com/' . $this->userInfo['username'] . '/picture?type=large';
        }
        return $result;
    }

    /**
     * Authenticate and return bool result of authentication
     *
     * @return bool
     */
    public function authenticate()
    {
        $result = false;
        if (isset($_GET['code'])) {
            $params = [
                'client_id' => $this->clientId,
                'redirect_uri' => $this->redirectUri,
                'client_secret' => $this->clientSecret,
                'code' => $_GET['code']
            ];
            $url = 'https://graph.facebook.com/v2.8/oauth/access_token?';
            $tokenInfo = json_decode(file_get_contents($url . urldecode(http_build_query($params))), true);
            if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
                $params = [
                    'access_token' => $tokenInfo['access_token'],
                    'fields' => 'id,name,email,friends'
                ];
                $url = 'https://graph.facebook.com/v2.8/me?';
                $userInfo = json_decode(file_get_contents($url . urldecode(http_build_query($params))), true);
                var_dump($userInfo);


                $userFriends = json_decode(file_get_contents('https://graph.facebook.com/v2.8/me/friends?' . urldecode(http_build_query([
                        'access_token' => $tokenInfo['access_token']
                    ]))), true);
                print_r($userFriends);
                if (isset($userInfo['id'])) {
                    $this->userInfo = $userInfo;
                    $result = true;
                }
            }
        }
        return $result;
    }

    /**
     * Prepare params for authentication url
     *
     * @return array
     */
    public function prepareAuthParams()
    {
        return [
            'auth_url' => 'https://www.facebook.com/dialog/oauth',
            'auth_params' => [
                'client_id' => $this->clientId,
                'redirect_uri' => $this->redirectUri,
                'response_type' => 'code',
                'scope' => 'email,user_birthday'
            ]
        ];
    }


}