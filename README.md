```
composer dump-autoload
```


```
require 'vendor/autoload.php';

$jwt = new \anillkas\App\JWT();

$privateKey = <<<PRIVATE_KEY
-----BEGIN RSA PRIVATE KEY-----
YOUR PRIVATE KEY
-----END RSA PRIVATE KEY-----
PRIVATE_KEY;

echo $jwt->createJwt($privateKey);

```
