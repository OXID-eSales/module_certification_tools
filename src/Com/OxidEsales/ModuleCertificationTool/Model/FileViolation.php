<?php


namespace Com\OxidEsales\ModuleCertificationTool\Model;


class FileViolation
{

    private $sFileName;
    private $sClass;
    private $sMethod;
    private $iBeginLine;
    private $iEndLine;
    private $sRule;

    public function getFile()
    {
        return $this->sFileName;
    }

    public function setFile( $sFileName )
    {
        $this->sFileName = $sFileName;
    }

    public function getClass()
    {
        return $this->sClass;
    }

    public function setClass( $sClass )
    {
        $this->sClass = $sClass;
    }

    public function getMethod()
    {
        return $this->sMethod;
    }

    public function setMethod( $sMethod )
    {
        $this->sMethod = $sMethod;
    }

    public function getBeginLine()
    {
        return $this->iBeginLine;
    }

    public function setBeginLine( $iBeginLine )
    {
        $this->iBeginLine = $iBeginLine;
    }

    public function setEndLine( $iEndLine )
    {
        $this->iEndLine = $iEndLine;
    }

    public function getRule()
    {
        return $this->sRule;
    }

    public function setRule( $sRule )
    {
        $this->sRule = $sRule;
    }
}