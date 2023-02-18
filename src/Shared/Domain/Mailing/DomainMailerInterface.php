<?php

namespace App\Shared\Domain\Mailing;

interface DomainMailerInterface
{
    public function prepare(string $to,string $subject,string $html);
    public function send();
}
