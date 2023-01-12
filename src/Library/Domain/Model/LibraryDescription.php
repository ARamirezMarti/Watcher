<?php

namespace App\Library\Domain\Model;

use App\Library\Domain\Exceptions\InvalidArgumentDomainException;

class LibraryDescription
{
    private string $Description;

    public function __construct(string|null $Description)
    {
        $this->checkIfNull($Description);

        $this->Description = $Description;
    }

    public function checkIfNull($Description): void
    {
        if (null == $Description) {
            throw InvalidArgumentDomainException::createFromMessage(sprintf('Description can not be null'));
        }
    }

    public function Value(): string
    {
        return $this->Description;
    }
}
