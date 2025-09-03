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

namespace Sylius\AdyenPlugin\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

final class CheckoutValidationException extends \InvalidArgumentException
{
    public function __construct(ConstraintViolationListInterface $violations)
    {
        $messages = [];
        foreach ($violations as $violation) {
            $messages[] = $violation->getMessage();
        }

        parent::__construct(implode(', ', $messages));
    }
}
