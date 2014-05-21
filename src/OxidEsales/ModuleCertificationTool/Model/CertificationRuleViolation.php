<?php


namespace OxidEsales\ModuleCertificationTool\Model;


class CertificationRuleViolation {

    /**
     * @var string
     */
    private $sFile;

    /**
     * @var int
     */
    private $iLine;

    /**
     * @var string
     */
    private $sClass;

    /**
     * @var string
     */
    private $sMethod;

    /**
     * @var string
     */
    private $sNamespace;

    /**
     * @param string $class
     */
    public function setClass( $class )
    {
        $this->sClass = $class;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->sClass;
    }

    /**
     * @param string $file
     */
    public function setFile( $file )
    {
        $this->sFile = $file;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->sFile;
    }

    /**
     * @param int $line
     */
    public function setLine( $line )
    {
        $this->iLine = $line;
    }

    /**
     * @return int
     */
    public function getLine()
    {
        return $this->iLine;
    }

    /**
     * @param string $method
     */
    public function setMethod( $method )
    {
        $this->sMethod = $method;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->sMethod;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace( $namespace )
    {
        $this->sNamespace = $namespace;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->sNamespace;
    }



} 