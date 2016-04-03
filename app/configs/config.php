<?php

return array(
    'production' => array(),
    'development' => array(
        'session' => array(
            'save_path'
        ),
        'basePath' => '/',
        'facebook' => array(
            'app_id' => '698822996887673',
            'app_secret' => 'bb5fa65d38bd277eb62c908f27eb206c',
            'access_token_retrieval' => 'https://graph.facebook.com/v2.3/oauth/access_token',
            'auth_retrieval' => 'https://www.facebook.com/dialog/oauth',
        ),
        'datadase_servers' => array (
            'basic_facebook_auth' => array(
                'adapter'   => 'mysql',
                'host'      => '127.0.0.1',
                'port'      => '3306',
                'username'  => 'facebook',
                'password'  => 'me@auth',
                'dbname'    => 'face_book_auth'
            )
        )
    )
);