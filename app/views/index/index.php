<html>
    <head>
        <title>Facebookauth</title>
    </head>
    <body>
        <div>
            <a href="<?php echo $config['facebook']['auth_retrieval']?>?client_id=<?php echo $config['facebook']['app_id'] ?>&redirect_uri=<?php echo $this->getBaseUrl() . '/auth/auth' ?>">
                Facebook_Login</a>
        </div>
    </body>
</html>
