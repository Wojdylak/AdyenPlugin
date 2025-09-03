<?php

/*
 * This file is part of the Sylius Adyen Plugin package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\AdyenPlugin\Checker;

use Sylius\AdyenPlugin\Exception\CheckoutValidationException;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class OrderCheckoutCompleteIntegrityChecker implements OrderCheckoutCompleteIntegrityCheckerInterface
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly array $validationGroups = ['sylius_checkout_complete'],
    ) {
    }

    public function check(OrderInterface $order): void
    {
        $constraintViolationList = $this->validator->validate(value: $order, groups: $this->validationGroups);
        if (0 < $constraintViolationList->count()) {
            throw new CheckoutValidationException($constraintViolationList);
        }
    }
}
