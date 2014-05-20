<?php

namespace Com\OxidEsales\ModuleCertificationTool\Model;

class ModuleCertificationResult
{

    private $aPrefixViolations;
    private $aGlobalViolations;
    private $aDirectoryViolations;
    private $oMdResult;

    public function getPrefixViolations()
    {
        return $this->aPrefixViolations;
    }

    public function setPrefixViolations( $aPrefixViolations )
    {
        $this->aPrefixViolations = $aPrefixViolations;
    }

    public function getGlobalViolations()
    {
        return $this->aGlobalViolations;
    }

    public function setGlobalViolations( $aGlobalViolations )
    {
        $this->aGlobalViolations = $aGlobalViolations;
    }

    public function getDirectoryViolations()
    {
        return $this->aDirectoryViolations;
    }

    public function setDirectoryViolations( $aDirectoryViolations )
    {
        $this->aDirectoryViolations = $aDirectoryViolations;
    }

    public function getMdResult()
    {
        return $this->oMdResult;
    }

    public function setMdResult( $oMdResult )
    {
        $this->oMdResult = $oMdResult;
    }
}
