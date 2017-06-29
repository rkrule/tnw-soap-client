<?php
namespace Tnw\SoapClient\Event;

use Symfony\Component\EventDispatcher\Event;

class RequestEvent extends Event
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }
}

