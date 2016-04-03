<?php

class AuthController extends Controller {

    const CODE_FACEBOOK_AUTH_EXPIRED = 100;

    /**
     * handles the auth call back from facebook
     */
    public function authAction() {
        $params = $this->getParams();

        if (empty($params['code'])) {
            throw new Exception('authorization code is not given', 1000);
        }

        $accessTokenUrl = $this->getConfig()['facebook']['access_token_retrieval'];
        $accessTokenUrl .= '?client_id=' . $this->getConfig()['facebook']['app_id'];
        $accessTokenUrl .= '&client_secret=' . $this->getConfig()['facebook']['app_secret'];
        $accessTokenUrl .= '&redirect_uri=' . $this->getBaseUrl() . '/auth/auth';
        $accessTokenUrl .= '&code=' . $params['code'];

        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_URL, $accessTokenUrl);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        $result = json_decode(curl_exec($curlHandle), TRUE);

        if (isset($result['error']) && $result['error']['code']  == self::CODE_FACEBOOK_AUTH_EXPIRED) {
            $redirectURL = $this->getConfig()['facebook']['auth_retrieval'];
            $redirectURL .= '?client_id=' . $this->getConfig()['facebook']['app_id'];
            $redirectURL .= '&redirect_uri=' . $this->getBaseUrl() . '/auth/auth';
            header('Location: '. $redirectURL);
            exit;
        }

    }
}