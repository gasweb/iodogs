<?php
namespace IodogsApplication\Service\Mail\Transport;

use Zend\Mail\Transport\Smtp,
    Zend\Mail\Transport\SmtpOptions;

class TransportService
{
    /** @var array $mailConfig */
    protected $mailConfig;

    public function __construct($mailConfig)
    {
        $this->mailConfig = $mailConfig;
    }

    public function getTransport($name)
    {
        if ($name && isset($this->mailConfig[$name]['transport']['options']))
        {
            $transport = new Smtp();
            $transport->setOptions(new SmtpOptions($this->mailConfig[$name]['transport']['options']));
            return $transport;
        }
    }
}