<?php

namespace App\Library\Domain\Model;

use App\Library\Domain\Exceptions\InvalidArgumentDomainException;

class LibraryName
{
    private $name;

    public function __construct($name)
    {
        $this->checkIfNull($name);
        $this->checkLenght($name);
        $this->name = $name;
    }

    public function checkLenght(string $name)
    {
        $len = strlen($name);
        if (strlen($name) <= 2 || strlen($name) > 50) {
            throw InvalidArgumentDomainException::createFromMessage(sprintf('Name argument has to be between %s and %s', 2, 10));
        }
    }

    public function checkIfNull($name)
    {
        if (null == $name) {
            throw InvalidArgumentDomainException::createFromMessage(sprintf('Name can not be null'));
        }
    }

    public function Value(): string
    {
        return $this->name;
    }
}
