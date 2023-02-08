<?php

namespace App\User\Domain\Exception;

class DatabaseException extends \DomainException
{
    public static function createFromMessage(string $message): self
    {
        return new self($message);
    }
}
