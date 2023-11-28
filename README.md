# Laravel Pay Pocket

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hpwebdeveloper/laravel-pay-pocket.svg?style=flat-square)](https://packagist.org/packages/hpwebdeveloper/laravel-pay-pocket)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hpwebdeveloper/laravel-pay-pocket/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hpwebdeveloper/laravel-pay-pocket/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/hpwebdeveloper/laravel-pay-pocket/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/hpwebdeveloper/laravel-pay-pocket/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hpwebdeveloper/laravel-pay-pocket.svg?style=flat-square)](https://packagist.org/packages/hpwebdeveloper/laravel-pay-pocket)

**Laravel Pay Pocket** is a simple package designed for Laravel applications, offering the flexibility to manage multiple wallet types within two dedicated database tables, `wallets` and `wallets_logs`.

* **Author**: Hamed Panjeh
* **Vendor**: hpwebdeveloper
* **Package**: laravel-pay-pocket
* **Version**:
* **PHP Version**: 8.1+
* **Laravel Version**: `10.x`
* **[Composer](https://getcomposer.org/):** `composer require hpwebdeveloper/laravel-pay-pocket`


### Support Policy

| Version    | Laravel        | PHP         | Release date | End of improvements | End of support |
|------------|----------------|-------------|--------------|---------------------|----------------|
| 1.x        | ^10.0 | 8.1 | Nov 30, 2023 | Mar 1, 2024         | Sep 6, 2024    |   |



## Installation



- **Step 1:** You can install the package via composer:

```bash
composer require hpwebdeveloper/laravel-pay-pocket
```

- **Step 2:** Publish and run the migrations with:

```bash
php artisan vendor:publish --tag="pay-pocket-migrations"
php artisan migrate
```


- **Step 3:** Publish the wallet types using

```bash
php artisan vendor:publish --tag="pay-pocket-wallets"
```

This command will automatically publish the `WalletEnums.php` file into your application's `app/Enums` directory.

## Usage

### Prepare User Model

To use this package you need to implements the `WalletOperations` into `User` model and utlize the  `ManagesWallet` trait.

```php

use HPWebdeveloper\LaravelPayPocket\Interfaces\WalletOperations;
use HPWebdeveloper\LaravelPayPocket\Traits\ManagesWallet;

class User extends Authenticatable implements WalletOperations
{
    use ManagesWallet;
}
```

### Prepare Wallets

In Laravel Pay Pocket, you have the flexibility to define the order in which wallets are prioritized for payments through the use of Enums. The order of wallets in the Enum file determines their priority level. The first wallet listed has the highest priority and will be used first for deducting order values. 

For example, consider the following wallet types defined in an Enum:
```php
namespace App\Enums;

enum WalletEnums: string
{
    case WALLET1 = 'wallet_1';
    case WALLET2 = 'wallet_2';
}

```
You have complete freedom to name your wallets as per your requirements and even add more wallet types to the Enum list.


In this particular setup, `wallet_1` (`WALLET1`) is given the highest priority. When an order payment is processed, the system will first attempt to use `wallet_1` to cover the cost. If `wallet_1` does not have sufficient funds, `wallet_2` (`WALLET2`) will be used next.

If the balance in `wallet_1` is 10 and the balance in `wallet_2` is 20, and you need to pay an order value of 15, the payment process will first utilize the entire balance of `wallet_1`. Since `wallet_1`'s balance is insufficient to cover the full amount, the remaining 5 will be deducted from `wallet_2`. After the payment, `wallet_2` will have a remaining balance of 15."


### Deposit

```php
$user = auth()->user();

$user->deposit('wallet_1', 100.22); // Deposit funds into 'wallet_1'

$user->deposit('wallet_2', 100); // Deposit funds into 'wallet_2'

// Or using provided facade

use HPWebdeveloper\LaravelPayPocket\Facades\LaravelPayPocket;

LaravelPayPocket::deposit($user, 'wallet_1', 100.22);

```

### Pay
```php
$user->pay(200); // Pay the value using the total combined balance available across all wallets

// Or using provided facade

use HPWebdeveloper\LaravelPayPocket\Facades\LaravelPayPocket;

LaravelPayPocket::pay($user, 100.22);
```

### Balance

- **Wallets**
```php
$user->walletBalance // Total combined balance available across all wallets

// Or using provided facade

LaravelPayPocket::checkBalance($user);
```

- **Particular Wallet**
```php
$user->getWalletBalanceByType('wallet_1') // Balance available in wallet_1
$user->getWalletBalanceByType('wallet_2') // Balance available in wallet_2

// Or using provided facade

LaravelPayPocket::walletBalanceByType('wallet_1');
```

## Testing

```bash
./vender/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Hamed Panjeh](https://github.com/HPWebdeveloper)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
