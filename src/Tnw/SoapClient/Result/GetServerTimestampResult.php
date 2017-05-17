<?php

namespace Tnw\SoapClient\Result;

class GetServerTimestampResult
{
    protected $timestamp;

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}