<?php


namespace OxidEsales\ModuleCertificationTool\Model;


class FileViolation
{

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */

    private $class;
    /**
     * @var string
     */

    private $method;
    /**
     * @var int
     */

    private $beginLine;
    /**
     * @var int
     */

    private $endLine;
    /**
     * @var string
     */
    private $rule;

    public function getFile()
    {
        return $this->fileName;
    }

    public function setFile($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getBeginLine()
    {
        return $this->beginLine;
    }

    public function setBeginLine($beginLine)
    {
        $this->beginLine = $beginLine;
    }

    public function setEndLine($endLine)
    {
        $this->endLine = $endLine;
    }

    public function getRule()
    {
        return $this->rule;
    }

    public function setRule($rule)
    {
        $this->rule = $rule;
    }
}