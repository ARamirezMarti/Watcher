<?php

namespace App\Shared\Infrastructure\Mailer;
use App\Shared\Domain\Mailing\DomainMailerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SymfonyMailer implements DomainMailerInterface
{

    private Email $email;
    private MailerInterface $Emailer;
   
    private const  FROM = 'dev@watcher.com'  ;

    public function __construct(MailerInterface $mailer){
        $this->email = new Email();
        $this->Emailer = $mailer;
        
    }

    public function prepare(string $to,string $subject,string $html) {
        $this->email->addFrom(self::FROM)
            ->addTo($to)
            ->subject($subject)        
            ->html($html);
    }
	
	public function send() {
        $this->Emailer->send($this->email);
	}
}
