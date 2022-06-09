<?php
require './config.php';
require './vendor/autoload.php';

$provider = new Stevenmaguire\OAuth2\Client\Provider\Microsoft([
    'clientId'                  => $config['clientId'],
    'clientSecret'              => $config['clientSecret'],
    'redirectUri'               => '/login-callback.php', // Full Redirection URL - http://localhost/project/login-callback.php
    'urlAuthorize'              => 'https://login.windows.net/common/oauth2/authorize',
    'urlAccessToken'            => 'https://login.windows.net/common/oauth2/token',
    'urlResourceOwnerDetails'   => 'https://outlook.office.com/api/v1.0/me',
    'scope'                     => 'wl.basic', 'wl.signin'
]);

$authUrl = $provider->getAuthorizationUrl();
$_SESSION['oauth2state'] = $provider->getState(); ?>

<html>

<head>
    <title>MS Office Login</title>
</head>

<body>
    <a target="_blank" href="<?php echo $authUrl; ?>">Login</a>
</body>

</html>