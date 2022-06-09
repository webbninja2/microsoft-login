<?php
require './config.php';
require './vendor/autoload.php';

$provider = new Stevenmaguire\OAuth2\Client\Provider\Microsoft([
    'clientId'                  => $config['clientId'],
    'clientSecret'              => $config['clientSecret'],
    'urlAuthorize'              => 'https://login.windows.net/common/oauth2/authorize',
    'urlAccessToken'            => 'https://login.windows.net/common/oauth2/token',
    'urlResourceOwnerDetails'   => 'https://outlook.office.com/api/v1.0/me',
    'scopes'                    => 'openid profile'
]);

// If we don't have an authorization code then get one
$authUrl = $provider->getAuthorizationUrl();
$_SESSION['oauth2state'] = $provider->getState();
header('Location: ' . $authUrl);
exit;
// Check given state against previously stored one to mitigate CSRF attack