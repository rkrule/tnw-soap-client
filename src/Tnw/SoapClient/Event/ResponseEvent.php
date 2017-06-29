<?php
namespace Tnw\SoapClient\Event;

use Symfony\Component\EventDispatcher\Event;

class ResponseEvent extends Event
{
    protected $response;

    /**
     *
     * @param RequestEvent $requestEvent
     * @param mixed $response   SaveResult[] or QueryResult
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}

