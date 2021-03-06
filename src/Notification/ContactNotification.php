<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactNotification {

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact) : void
    {
        
        $email = (new TemplatedEmail())
                    ->from("EscabocheDev@gmail.com")
                    ->to($contact->getMail())
                    ->subject("Demande de contact")
                    ->htmlTemplate('Notification\Contact.html')
                    ->context(["contact" => $contact]) ;

        $this->mailer->send($email);
    }
}