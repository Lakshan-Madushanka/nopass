<div align="center">

**[Overview](#overview)** |
**[How it works](#how-it-works)** |
**[Verification link](#verification-link)** |
**[OTP code](#otp-code)** |
**[Usage examples](#usage-examples)** |
**[Changelog](#changelog)** |
**[Testing](#testing)** |
**[Security](#security)** |
**[License](#license)**

<img src="https://github.com/user-attachments/assets/9438aee5-a6f0-4399-bcae-e764f564ad35" width="580" alt="Commenter logo">

# <img src="https://github.com/user-attachments/assets/1684696e-0dc0-4cda-ae00-6dcd77bc36c6">

**Passwords are no longer secure!**

[![Laravel](https://img.shields.io/badge/laravel-%5E10.0%20%7C%20%5E11.0-red)](https://laravel.com)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/Lakshan-Madushanka/nopass/run-tests.yml)](https://github.com/Lakshan-Madushanka/nopass/actions?query=workflow%3ATests+branch%3Amain)
[![Packagist Version](https://img.shields.io/packagist/v/lakm/nopass)](https://packagist.org/packages/lakm/nopass)
[![Downloads](https://img.shields.io/packagist/dt/lakm/nopass)](https://packagist.org/packages/lakm/nopass)
[![GitHub License](https://img.shields.io/github/license/Lakshan-Madushanka/laravel-comments)](https://github.com/Lakshan-Madushanka/laravel-comments/blob/main/LICENSE.md)
</div>

## Overview

"I'm so fed up with passwords! I have to reset them all the time."

"Oh no, my passwords were leaked. I bet it's my password manager's fault."

"Someone accessed my account—I think they guessed my weak password."

We've all encountered one of these issues at some point. As the internet has evolved, there are now websites for almost
everything we need. Modern users often have more than five accounts online.

How many online accounts do you have? The answer is likely more than one—probably more than 10. So, how do you manage to
remember the passwords for each of these accounts? Here are a few options you might consider:

- Memorize them.
- Use a password manager.
- Reset your password every time you forget it. 😂

We can easily rule out the first option since most of us aren't blessed with a superhuman memory. While password
managers are a popular choice, their security isn't foolproof—data breaches and password leaks happen far too often,
making them a less-than-reliable option.

That is the users' side of story. It's our responsibility to provide more convenience authentication methods for our
users and improve user experiences.
That is what this package made for.

> !Note
> The package doesn't provide any authentication method. Instead, it provides two methods to use in your existing auth
> system.
> You can use any authentication like breeze, jetstream or custom one. Sample implementation has been provided in demo
> project

## How it works

The package offers two methods for verification: sending a verification link to the user's email address or sending an
OTP (One-Time Password) to the user's mobile number.

## Verification link

### Generate a link

```php
    use LakM\NoPass\Facades\NoPass;
    
    $data = [];
    
    $link = NoPass::for($user)
        ->email()
        ->routeName('login-link')
        ->generate($data); // Data are attached to query string
```

## OTP Code

### Generate a OTP code

```php
    use LakM\NoPass\Facades\NoPass;
    
    $link = NoPass::for($user)
        ->otp()
        ->generate();
```

## Check validity

### Check Email

```php
    use LakM\NoPass\Facades\NoPass;
    
    $isValid = NoPass::for($user)
            ->isValid();
```
### Check OTP

```php
    use LakM\NoPass\Facades\NoPass;
    
    $isValid = NoPass::for($user)
            ->isValid($otp);
```

## Invalidate

```php
    use LakM\NoPass\Facades\NoPass;
    
    $isValid = NoPass::for($user)
            ->inValidate();
```

## Usage Examples

- [Send login link](https://github.com/Lakshan-Madushanka/laravel-comments/blob/9f1c325caa877dc804335e436abba9f5e9450bf7/src/SecureGuestModeManager.php#L47)
- [Authenticate link](https://github.com/Lakshan-Madushanka/laravel-comments/blob/9f1c325caa877dc804335e436abba9f5e9450bf7/src/Actions/VerifyGuestAction.php#L16)

## Changelog

Please see [CHANGELOG](https://github.com/Lakshan-Madushanka/laravel-comments/blob/main/CHANGELOG.md) for more
information what has changed recently.

## Testing

```bash
./vendor/bin/pest
```

## Security

Please see [here](https://github.com/Lakshan-Madushanka/laravel-comments/blob/main/SECURITY.md) for our security policy.

## License

The MIT License (MIT). Please
see [License File](https://github.com/Lakshan-Madushanka/laravel-comments/blob/main/LICENSE.md) for more information.
