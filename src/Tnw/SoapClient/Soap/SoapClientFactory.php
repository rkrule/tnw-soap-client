<?php
namespace Tnw\SoapClient\Soap;

use Tnw\SoapClient\Soap\TypeConverter;

/**
 * Factory to create a \SoapClient properly configured for the Salesforce SOAP
 * client
 */
class SoapClientFactory
{
    /**
     * Default classmap
     *
     * @var array
     */
    protected $classmap = array(
        'ChildRelationship'     => 'Tnw\SoapClient\Result\ChildRelationship',
        'DeleteResult'          => 'Tnw\SoapClient\Result\DeleteResult',
        'DeletedRecord'         => 'Tnw\SoapClient\Result\DeletedRecord',
        'DescribeGlobalResult'  => 'Tnw\SoapClient\Result\DescribeGlobalResult',
        'DescribeGlobalSObjectResult' => 'Tnw\SoapClient\Result\DescribeGlobalSObjectResult',
        'DescribeSObjectResult' => 'Tnw\SoapClient\Result\DescribeSObjectResult',
        'DescribeTab'           => 'Tnw\SoapClient\Result\DescribeTab',
        'EmptyRecycleBinResult' => 'Tnw\SoapClient\Result\EmptyRecycleBinResult',
        'Error'                 => 'Tnw\SoapClient\Result\Error',
        'Field'                 => 'Tnw\SoapClient\Result\DescribeSObjectResult\Field',
        'GetDeletedResult'      => 'Tnw\SoapClient\Result\GetDeletedResult',
        'GetServerTimestampResult' => 'Tnw\SoapClient\Result\GetServerTimestampResult',
        'GetUpdatedResult'      => 'Tnw\SoapClient\Result\GetUpdatedResult',
        'GetUserInfoResult'     => 'Tnw\SoapClient\Result\GetUserInfoResult',
        'LeadConvert'           => 'Tnw\SoapClient\Request\LeadConvert',
        'LeadConvertResult'     => 'Tnw\SoapClient\Result\LeadConvertResult',
        'LoginResult'           => 'Tnw\SoapClient\Result\LoginResult',
        'MergeResult'           => 'Tnw\SoapClient\Result\MergeResult',
        'QueryResult'           => 'Tnw\SoapClient\Result\QueryResult',
        'SaveResult'            => 'Tnw\SoapClient\Result\SaveResult',
        'SearchResult'          => 'Tnw\SoapClient\Result\SearchResult',
        'SendEmailError'        => 'Tnw\SoapClient\Result\SendEmailError',
        'SendEmailResult'       => 'Tnw\SoapClient\Result\SendEmailResult',
        'SingleEmailMessage'    => 'Tnw\SoapClient\Request\SingleEmailMessage',
        'sObject'               => 'Tnw\SoapClient\Result\SObject',
        'UndeleteResult'        => 'Tnw\SoapClient\Result\UndeleteResult',
        'UpsertResult'          => 'Tnw\SoapClient\Result\UpsertResult',
    );

    /**
     * Type converters collection
     *
     * @var TypeConverter\TypeConverterCollection
     */
    protected $typeConverters;

    /**
     * @param string $wsdl Path to WSDL file
     * @param array $soapOptions
     * @return SoapClient
     */
    public function factory($wsdl, array $soapOptions = array())
    {
        $defaults = array(
            'trace'      => 1,
            'features'   => \SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap'   => $this->classmap,
            'typemap'    => $this->getTypeConverters()->getTypemap(),
            'cache_wsdl' => \WSDL_CACHE_MEMORY
        );

        $options = array_merge($defaults, $soapOptions);

        return new SoapClient($wsdl, $options);
    }

    /**
     * test
     *
     * @param string $soap SOAP class
     * @param string $php  PHP class
     */
    public function setClassmapping($soap, $php)
    {
        $this->classmap[$soap] = $php;
    }

    /**
     * Get type converter collection that will be used for the \SoapClient
     *
     * @return TypeConverter\TypeConverterCollection
     */
    public function getTypeConverters()
    {
        if (null === $this->typeConverters) {
            $this->typeConverters = new TypeConverter\TypeConverterCollection(
                array(
                    new TypeConverter\DateTimeTypeConverter(),
                    new TypeConverter\DateTypeConverter()
                )
            );
        }

        return $this->typeConverters;
    }

    /**
     * Set type converter collection
     *
     * @param TypeConverter\TypeConverterCollection $typeConverters Type converter collection
     *
     * @return SoapClientFactory
     */
    public function setTypeConverters(TypeConverter\TypeConverterCollection $typeConverters)
    {
        $this->typeConverters = $typeConverters;

        return $this;
    }
}
