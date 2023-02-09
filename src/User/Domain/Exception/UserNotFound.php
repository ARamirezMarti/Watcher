<?php

namespace App\User\Domain\Exception;

class UserNotFound extends \InvalidArgumentException
{
    public static function createFromMessage(string $message): self{
        return new self($message);
    }
}
