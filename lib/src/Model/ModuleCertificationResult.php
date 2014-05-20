<?php


class ModuleCertificationResult {

    private $aPrefixViolations;
    private $aGlobalViolations;
    private $aDirectoryViolations;

    public function setPrefixViolations( $aPrefixViolations )
    {
       $this->aPrefixViolations = $aPrefixViolations;
    }

    public function setGlobalViolations( $aGlobalViolations )
    {
        $this->aGlobalViolations = $aGlobalViolations;
    }

    public function setDirectoryViolations( $aDirectoryViolations )
    {
        $this->aDirectoryViolations = $aDirectoryViolations;
    }
}
