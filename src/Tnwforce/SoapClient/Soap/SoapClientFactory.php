<?php
namespace Tnwforce\SoapClient\Soap;

use Tnwforce\SoapClient\Soap\TypeConverter;

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
        'ChildRelationship'     => 'Tnwforce\SoapClient\Result\ChildRelationship',
        'DeleteResult'          => 'Tnwforce\SoapClient\Result\DeleteResult',
        'DeletedRecord'         => 'Tnwforce\SoapClient\Result\DeletedRecord',
        'DescribeGlobalResult'  => 'Tnwforce\SoapClient\Result\DescribeGlobalResult',
        'DescribeGlobalSObjectResult' => 'Tnwforce\SoapClient\Result\DescribeGlobalSObjectResult',
        'DescribeSObjectResult' => 'Tnwforce\SoapClient\Result\DescribeSObjectResult',
        'DescribeTab'           => 'Tnwforce\SoapClient\Result\DescribeTab',
        'EmptyRecycleBinResult' => 'Tnwforce\SoapClient\Result\EmptyRecycleBinResult',
        'Error'                 => 'Tnwforce\SoapClient\Result\Error',
        'Field'                 => 'Tnwforce\SoapClient\Result\DescribeSObjectResult\Field',
        'GetDeletedResult'      => 'Tnwforce\SoapClient\Result\GetDeletedResult',
        'GetServerTimestampResult' => 'Tnwforce\SoapClient\Result\GetServerTimestampResult',
        'GetUpdatedResult'      => 'Tnwforce\SoapClient\Result\GetUpdatedResult',
        'GetUserInfoResult'     => 'Tnwforce\SoapClient\Result\GetUserInfoResult',
        'LeadConvert'           => 'Tnwforce\SoapClient\Request\LeadConvert',
        'LeadConvertResult'     => 'Tnwforce\SoapClient\Result\LeadConvertResult',
        'LoginResult'           => 'Tnwforce\SoapClient\Result\LoginResult',
        'MergeResult'           => 'Tnwforce\SoapClient\Result\MergeResult',
        'QueryResult'           => 'Tnwforce\SoapClient\Result\QueryResult',
        'SaveResult'            => 'Tnwforce\SoapClient\Result\SaveResult',
        'SearchResult'          => 'Tnwforce\SoapClient\Result\SearchResult',
        'SendEmailError'        => 'Tnwforce\SoapClient\Result\SendEmailError',
        'SendEmailResult'       => 'Tnwforce\SoapClient\Result\SendEmailResult',
        'SingleEmailMessage'    => 'Tnwforce\SoapClient\Request\SingleEmailMessage',
        'sObject'               => 'Tnwforce\SoapClient\Result\SObject',
        'UndeleteResult'        => 'Tnwforce\SoapClient\Result\UndeleteResult',
        'UpsertResult'          => 'Tnwforce\SoapClient\Result\UpsertResult',
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
