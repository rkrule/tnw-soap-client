<?php

namespace Tnw\SoapClient\Result;

class DescribeGlobalResult
{
    public $encoding;
    public $maxBatchSize;
    /** @var DescribeGlobalSObjectResult[] */
    public $sobjects = array();
}