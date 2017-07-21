<?php

namespace Tnw\SoapClient\Result;

/**
 * An error
 */
class Error
{
    protected $fields;
    protected $message;
    protected $statusCode;

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getMessage();
    }
}
