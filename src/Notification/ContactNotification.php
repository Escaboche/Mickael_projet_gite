<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactNotification {

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact){
        
        $email = (new TemplatedEmail())
                    ->from("EscabocheDev@gmail.com")
                    ->to($contact->getMail())
                    ->subject("Demande de contact")
                    ->htmlTemplate('Notification\contact.html.twig')
                    ->context(["contact" => $contact]);

        $this->mailer->send($email);
    }
}