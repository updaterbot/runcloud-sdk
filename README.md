# RunCloud API PHP SDK

This SDK helps you make API calls to the [RunCloud](https://runcloud.io) Version 2 API and is a fork of the [RunCloud PHP SDK](https://github.com/16bitsrl/runcloud-php-sdk).

[RunCloud API Documentation](https://runcloud.io/docs/api)


## Installation

Install the SDK in your project using Composer:

```
composer require updaterbot/runcloud-sdk
```

Use Composer's autoload:

```php
require __DIR__ . '/../vendor/autoload.php';
```

Create an instance of the SDK:

```php
$runcloud = new OnHover\RunCloud\RunCloud('MY_API_KEY', 'MY_API_SECRET');
```


## Usage

You can use the `$runcloud` instance to make all available API calls.

To find out all available methods, inspect the appropriate classes in the `Actions`
directory. The names of these classes and functions  closely follow the
[RunCloud API Documentation](https://runcloud.io/docs/api).


## Examples

```php
$response = $runcloud->ping();
```

This tests the connection to the API and should return the string "pong".

```php
$servers = $runcloud->servers();
```

This will return an array of servers you have access to. Each array item will be
an instance of `OnHover\RunCloud\Resources\Server` and contains various properties
such as `id`, `name`, `provider` and `ipAddress`.

You can return a single Server instance like this:

```php
$serverId = 12345;
$server = $runcloud->server($serverId);
```

Some methods require parameters to be supplied as an array.

```php
$serverId = 12345;

$data = [
	'type' => 'global',
	'port' => '8080-8081',
	'protocol' => 'tcp',
];

$rule = $runcloud->createFirewallRule($serverId, $data);
```


## Security

If you discover any security related issues, please email [code@onhover.co.uk](mailto:code@onhover.co.uk) instead of using the issue tracker.

## Credits

- [Mattia Trapani](https://github.com/zupolgec)
- [Pier Trapani](https://github.com/piertrapani)

This package uses code from and is greatly inspired by the [Forge SDK package](https://github.com/themsaid/forge-sdk) by [Mohammed Said](https://github.com/themsaid) and the [Oh Dear PHP SDK package](https://github.com/ohdearapp/ohdear-php-sdk).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
