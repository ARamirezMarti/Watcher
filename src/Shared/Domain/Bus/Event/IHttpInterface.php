<?php

namespace App\Shared\Domain\Bus\Event;
use Psr\Http\Message\ResponseInterface;

interface IHttpInterface
{
    public function get(string $url,array $Options):ResponseInterface;
}
