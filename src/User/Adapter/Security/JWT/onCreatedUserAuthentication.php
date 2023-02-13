<?php

namespace App\User\Adapter\Security\JWT;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class onCreatedUserAuthentication
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event){
        $Data = $event->getData();
        $Data['user_id'] = $event->getUser()->getUserIdentifier();
        $event->setData($Data);
    }
}
