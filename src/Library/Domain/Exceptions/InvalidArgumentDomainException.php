<?php

namespace App\Library\Domain\Exceptions;

class InvalidArgumentDomainException extends \InvalidArgumentException
{
    public static function createFromMessage(string $message): self
    {
        return new static($message);
    }

    public static function createFromArgument(string $argument): self
    {
        return new static(\sprintf('Invalid argument [%s]', $argument));
    }

    public static function createFromArray(array $arguments): self
    {
        return new static(\sprintf('Invalid arguments [%s]', \implode(', ', $arguments)));
    }
}
