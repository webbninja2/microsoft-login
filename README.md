## Login with Microsoft (Azure)

- [Microsoft SDK](https://github.com/stevenmaguire/oauth2-microsoft)
- [Microsoft API Docs](https://docs.microsoft.com/en-us/azure/industry/training-services/microsoft-community-training/get-started/microsoft-community-training-overview)
- [Grab Client ID & Secret](https://docs.microsoft.com/en-us/azure/industry/training-services/microsoft-community-training/frequently-asked-questions/generate-new-clientsecret-link-to-key-vault)

## Composer Compatible

```bash
composer install
```

## Configuration
```php
$config = [
    'clientId'      => '{clientId}',
    'clientSecret'  => '{clientSecret}',
];

```

## Example Usage
```php
$provider = new Stevenmaguire\OAuth2\Client\Provider\Microsoft([
    'clientId'                  => $config['clientId'],
    'clientSecret'              => $config['clientSecret'],
    'urlAuthorize'              => 'https://login.windows.net/common/oauth2/authorize',
    'urlAccessToken'            => 'https://login.windows.net/common/oauth2/token',
    'urlResourceOwnerDetails'   => 'https://outlook.office.com/api/v1.0/me',
    'scopes'                    => 'openid profile'
]);

if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    die('State Is Missing or Invalid State');

} else {

    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    try {
        // Success | Got access token
        $user = $provider->getResourceOwner($token);
        echo "Hello " . $user->getFirstname();
    } catch (Exception $e) {
        // Error
        echo $e->getMessage();
    }

    echo $token->getToken();
}

```
