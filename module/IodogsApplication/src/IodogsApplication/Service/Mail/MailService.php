<?php
namespace IodogsApplication\Service\Mail;

use Zend\Mail\Message;

class MailService
{

    /** @var \IodogsApplication\Service\Mail\Transport\TransportService */
    protected $transportService;

    /** @var  array $mailConfig */
    protected $mailConfig;

    public function __construct($transportService, $mailConfig)
    {
        $this->transportService = $transportService;
        $this->mailConfig = $mailConfig;
    }

    public function sendContactUs($data)
    {
        $message = "
        Имя: {$data['name']}
        Email: {$data['email']}
        
        ";
        $message .= $data['message'];

        $header = (!empty($data['header'])) ? $data['header'] : 'iodogs: сообщение из формы контактов';
        $mail = new Message();
        $mail->setEncoding('UTF-8');
        $mail->setBody($message);
        $mail->setFrom('mail@isleofdogs.ru', 'Isle Of Dogs');
        $mail->addTo('big-papa@mail.ru', 'Gas Smith');
        $mail->setSubject($header);
        $transport = $this->transportService->getTransport("contact-us");
        $transport->send($mail);
    }
}