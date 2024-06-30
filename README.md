![Laravel Pay Pocket](https://github.com/HPWebdeveloper/laravel-pay-pocket/assets/16323354/8e8ebcf6-f8d4-4811-b97c-fb6362e3f019)

# Laravel Pay Pocket

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hpwebdeveloper/laravel-pay-pocket.svg?style=flat-square)](https://packagist.org/packages/hpwebdeveloper/laravel-pay-pocket)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hpwebdeveloper/laravel-pay-pocket/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hpwebdeveloper/laravel-pay-pocket/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/hpwebdeveloper/laravel-pay-pocket/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/hpwebdeveloper/laravel-pay-pocket/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Imports](https://github.com/HPWebdeveloper/laravel-pay-pocket/actions/workflows/check_imports.yml/badge.svg?branch=main)](https://github.com/HPWebdeveloper/laravel-pay-pocket/actions/workflows/check_imports.yml)

**Laravel Pay Pocket** is a package designed for Laravel applications, offering the flexibility to manage multiple wallet types within two dedicated database tables, `wallets` and `wallets_logs`.

**Demo:** https://github.com/HPWebdeveloper/demo-pay-pocket

**Videos:** 

- [Laravel Pay Pocket Package: Virtual Wallets in Your Project](https://www.youtube.com/watch?v=KoQyURiwsA4)

- [Laravel Exceptions: Why and How to Use? Practical Example.](https://www.youtube.com/watch?v=-Sr18w91v8Q)

- [PHP Enums in Laravel: Practical Example from Package](https://www.youtube.com/watch?v=iUOb-3HQtK8)


**Note:** This package does not handle payments from payment platforms, but instead offers the concept of virtual money, deposit, and withdrawal.

-   **Author**: Hamed Panjeh
-   **Vendor**: hpwebdeveloper
-   **Package**: laravel-pay-pocket
-   **Alias name**: Laravel PPP (Laravel Pay Pocket Package)
-   **Version**: `2.x`
-   **PHP Version**: 8.1+
-   **Laravel Version**: `10.x`, `11.x`
-   **[Composer](https://getcomposer.org/):** `composer require hpwebdeveloper/laravel-pay-pocket`

### Support Policy

| Version                                         | Laravel      | PHP         | Release date  | End of improvements | End of support |
|-------------------------------------------------|--------------|-------------|---------------|---------------------| -------------- |
| 1.x                                             | ^10.0        | 8.1, 8.2, 8.3 | Nov 30, 2023  | Mar 1, 2024         |                |
| 2.x                                             | ^10.0, ^11.0 |8.2, 8.3| June 27, 2024 | January 30, 2025    |                |
| 3.x  (atomic operations and restricted wallets) | ^11.0 |8.2, 8.3| comming soon  |    |                |

## Installation:

-   **Step 1:** You can install the package via composer:

```bash
composer require hpwebdeveloper/laravel-pay-pocket
```

-   **Step 2:** Publish and run the migrations with:

```bash
php artisan vendor:publish --tag="pay-pocket-migrations"
php artisan migrate
```

You have successfully added two dedicated database tables, `wallets` and `wallets_logs`, without making any modifications to the `users` table.

-   **Step 3:** Publish the wallet types using

```bash
php artisan vendor:publish --tag="pay-pocket-wallets"
php artisan vendor:publish --tag="config"
```

This command will automatically publish the `pay-pocket.php` config file and also `WalletEnums.php` file into your application's `config` and `app/Enums` directories respectively.

## Updating

If updating to version `^2.0.0`, new migration and config files have been added to support the new [Transaction Notes Feature](#transaction-notes-8)

Follow the [Installation](#installation) Steps 2 and 3 to update your migrations.

## Preparation

### Prepare User Model

To use this package you need to implement the `WalletOperations` into `User` model and utilize the `ManagesWallet` trait.

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

For example, consider the following wallet types defined in the Enum class (published in step 3 of installation):

```php
namespace App\Enums;

enum WalletEnums: string
{
    case WALLET1 = 'wallet_1';
    case WALLET2 = 'wallet_2';
}

```

**You have complete freedom to name your wallets as per your requirements and even add more wallet types to the Enum list.**

In this particular setup, `wallet_1` (`WALLET1`) is given the **highest priority**. When an order payment is processed, the system will first attempt to use `wallet_1` to cover the cost. If `wallet_1` does not have sufficient funds, `wallet_2` (`WALLET2`) will be used next.

### Example:

If the balance in `wallet_1` is 10 and the balance in `wallet_2` is 20, and you need to pay an order value of 15, the payment process will first utilize the entire balance of `wallet_1`. Since `wallet_1`'s balance is insufficient to cover the full amount, the remaining 5 will be deducted from `wallet_2`. After the payment, `wallet_2` will have a remaining balance of 15."

## Usage, APIs and Operations:

### Deposit

```php
deposit(type: 'wallet_1', amount: 123.45, notes: null)
```

Deposit funds into `wallet_1`

```php
$user = auth()->user();
$user->deposit('wallet_1', 123.45);
```

Deposit funds into `wallet_2`

```php
$user = auth()->user();
$user->deposit('wallet_2', 67.89);
```

Or using provided facade

```php
use HPWebdeveloper\LaravelPayPocket\Facades\LaravelPayPocket;

$user = auth()->user();
LaravelPayPocket::deposit($user, 'wallet_1', 123.45);

```

Note: `wallet_1` and `wallet_2` must already be defined in the `WalletEnums`.

#### Transaction Info ([#8][i8])

When you need to add descriptions for a specific transaction, the `$notes` parameter enables you to provide details explaining the reason behind the transaction.

```php
$user = auth()->user();
$user->deposit('wallet_1', 67.89, 'You ordered pizza.');
```

### Pay

```php
pay(amount: 12.34, notes: null)
```

Pay the value using the total combined balance available across all allowed wallets

```php
$user = auth()->user();
$user->pay(12.34);
```

Or using provided facade

```php
use HPWebdeveloper\LaravelPayPocket\Facades\LaravelPayPocket;

$user = auth()->user();
LaravelPayPocket::pay($user, 12.34);
```

### Balance

-   **Wallets**

```php
$user->walletBalance // Total combined balance available across all wallets

// Or using provided facade

LaravelPayPocket::checkBalance($user);
```

-   **Particular Wallet**

```php
$user->getWalletBalanceByType('wallet_1') // Balance available in wallet_1
$user->getWalletBalanceByType('wallet_2') // Balance available in wallet_2

// Or using provided facade

LaravelPayPocket::walletBalanceByType($user, 'wallet_1');
```

### Exceptions

Upon examining the `src/Exceptions` directory within the source code,
you will discover a variety of exceptions tailored to address each scenario of invalid entry. Review the [demo](https://github.com/HPWebdeveloper/demo-pay-pocket) that accounts for some of the exceptions.

### Log

A typical `wallets_logs` table.
![Laravel Pay Pocket Log](https://github.com/HPWebdeveloper/laravel-pay-pocket/assets/16323354/0d7f2237-88e1-4ac0-a4f2-ac200bad9273)

## Testing

```bash
composer install

composer test


// Or

./vender/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Hamed Panjeh](https://github.com/HPWebdeveloper)
-   [All Contributors](../../contributors)
-   Icon in the above image: pocket by Creative Mahira from [Noun Project](https://thenounproject.com/browse/icons/term/pocket/) (CC BY 3.0)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[i8]: https://github.com/HPWebdeveloper/laravel-pay-pocket/releases/tag/2.0.0
