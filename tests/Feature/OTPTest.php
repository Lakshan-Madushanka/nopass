<?php

declare(strict_types=1);

use LakM\NoPass\NoPassManager;

it('can generate a otp code', function (): void {
    $user = user();

    $code = (new NoPassManager())
        ->for($user)
        ->otp()
        ->generate();

    expect($code)->not->toBeNull()
        ->and(strlen($code))->toBe(5);
});

it('can validate otp code', function (): void {
    $user = user();

    $noPass = (new NoPassManager())
        ->for($user)
        ->otp();

    $otp = $noPass->generate();

    expect($noPass->isValid($otp))->toBeTrue()
        ->and($noPass->isValid(random_int(0, 100000)))->toBeFalse();
});

it('can inValidate previous otp code', function (): void {
    $user = user();

    $noPass = (new NoPassManager())
        ->for($user)
        ->otp();

    $code1 = $noPass->generate();
    $code2 = $noPass->generate();

    expect($noPass->isValid($code1))->toBeFalse()
        ->and($noPass->isValid($code2))->toBeTrue();
});

it('can inValidate a otp code', function (): void {
    $user = user();

    $noPass = (new NoPassManager())
        ->for($user)
        ->otp();

    $code1 = $noPass->generate();

    expect($noPass->inValidate())->toBeTrue()
        ->and($noPass->isValid($code1))->toBeFalse();
});
