<?php
namespace Tnw\SoapClient\Plugin;

use Tnw\SoapClient\Event\RequestEvent;
use Tnw\SoapClient\Event\ResponseEvent;
use Tnw\SoapClient\Event\FaultEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\LoggerInterface;

/**
 * A plugin that logs messages
 *
 *  */
class LogPlugin implements EventSubscriberInterface
{
    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onClientRequest(RequestEvent $event)
    {
        $this->logger->debug(sprintf(
            "request: body\n%s",
            \print_r($event->getRequest(), true)
        ));
    }

    public function onClientResponse(ResponseEvent $event)
    {
        $this->logger->debug(sprintf(
            "response: body\n%s",
            \print_r($event->getResponse(), true)
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'phpforce.soap_client.request'  => 'onClientRequest',
            'phpforce.soap_client.response' => 'onClientResponse'
        );
    }
}