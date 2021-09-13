<?php
namespace Tnw\SoapClient;

use Tnw\SoapClient\Soap\SoapClientFactory;
use Tnw\SoapClient\Plugin\LogPlugin;
use Psr\Log\LoggerInterface;

/**
 * Salesforce SOAP client builder
 *
 * @author David de Boer <david@ddeboer.nl>
 */
class ClientBuilder
{
    protected $log;

    /**
     * Construct client builder with required parameters
     *
     * @param string $wsdl        Path to your Salesforce WSDL
     * @param string $location    Path to SFDC Endpoint Location
     * @param string $username    Your Salesforce username
     * @param string $password    Your Salesforce password
     * @param string $token       Your Salesforce security token
     * @param array  $soapOptions Further options to be passed to the SoapClient
     */
    public function __construct($wsdl, $location, $username, $password, $token, array $soapOptions = array())
    {
        $this->wsdl = $wsdl;
        $this->location = $location;
        $this->username = $username;
        $this->password = $password;
        $this->token = $token;
        $this->soapOptions = $soapOptions;
    }

    /**
     * Enable logging
     *
     * @param LoggerInterface $log Logger
     *
     * @return ClientBuilder
     */
    public function withLog(LoggerInterface $log)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * Build the Salesforce SOAP client
     *
     * @return Client
     */
    public function build()
    {
        $soapClientFactory = new SoapClientFactory();
        $soapClient = $soapClientFactory->factory($this->wsdl, $this->soapOptions);

        if($this->location)
        {
            $soapClient->__setLocation($this->location);
        }
        
        $client = new Client($soapClient, $this->username, $this->password, $this->token);

        if ($this->log) {
            $logPlugin = new LogPlugin($this->log);
            $client->getEventDispatcher()->addSubscriber($logPlugin);
        }

        return $client;
    }
}
