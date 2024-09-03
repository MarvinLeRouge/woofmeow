<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MailItController extends AbstractController
{
    #[Route('/mailit', name: 'app_mailit')]
    public function index(MailerInterface $mailer): Response
    {
        $to = "nizar@tralala.com";
        $subject = "Rappel vaccination de ton varan de Komodo " . date("H:i:s");
        $content = "Coucou je suis le mail de nizar " . date("H:i:s");
        //dd(compact("to", "subject", "content"));
        $email = (new Email())->from("contact@woofmeow.com")->to($to)->subject($subject)->text($content)->html(nl2br($content));
        try {
            $mailer->send($email);
        }
        catch (TransportExceptionInterface $e) {
            dd($e);
        }
        return $this->render('mailit/index.html.twig', [
            'controller_name' => 'MailItController',

        ]);

    }
}
