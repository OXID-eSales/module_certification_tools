<?php


namespace OxidEsales\ModuleCertificationTool\Model;


class CertificationResult
{

    /**
     * @var float
     */
    private $fFactor;

    /**
     * @var float
     */
    private $fPrice;

    /**
     * @var array()
     */
    private $aCertificationRules;

    /**
     * @var array()
     */
    private $aViolations;

    /**
     * @param array $aCertificationRules
     */
    public function setCertificationRules( $aCertificationRules )
    {
        $this->aCertificationRules = $aCertificationRules;
    }

    /**
     * @return array
     */
    public function getCertificationRules()
    {
        return $this->aCertificationRules;
    }

    public function getCertificationRule( $sName )
    {
        return $this->aCertificationRules[ $sName ];
    }

    /**
     * @param float $fFactor
     */
    public function setFactor( $fFactor )
    {
        $this->fFactor = $fFactor;
    }

    /**
     * @return float
     */
    public function getFactor()
    {
        return $this->fFactor;
    }

    /**
     * @param float $fPrice
     */
    public function setPrice( $fPrice )
    {
        $this->fPrice = $fPrice;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->fPrice;
    }

    public function getViolations()
    {
        return $this->aViolations;
    }

    public function setViolations( $aViolations )
    {
        $this->aViolations = $aViolations;
    }


}