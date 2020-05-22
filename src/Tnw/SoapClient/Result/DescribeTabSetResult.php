<?php
/**
 * Description of DescribeTabsResult
 *
 * @author "David de Boer <david@ddeboer.nl>"
 */

namespace Tnw\SoapClient\Result;

class DescribeTabSetResult
{
    protected $label;

    protected $logoUrl;

    protected $namespace;

    protected $selected;

    protected $tabs;

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return mixed
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * @return mixed
     */
    public function getTabs()
    {
        return $this->tabs;
    }

}

