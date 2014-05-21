<?php


namespace OxidEsales\ModuleCertificationTool\Model;


class CertificationResult
{

    /**
     * @var float
     */
    private $factor;

    /**
     * @var float
     */
    private $price;

    /**
     * @var array()
     */
    private $certificationRules;

    /**
     * @var array()
     */
    private $violations;

    /**
     * @param array $certificationRules
     */
    public function setCertificationRules($certificationRules)
    {
        $this->certificationRules = $certificationRules;
    }

    /**
     * @return array
     */
    public function getCertificationRules()
    {
        return $this->certificationRules;
    }

    public function getCertificationRule($name)
    {
        return $this->certificationRules[$name];
    }

    /**
     * @param float $factor
     */
    public function setFactor($factor)
    {
        $this->factor = $factor;
    }

    /**
     * @return float
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function getViolations()
    {
        return $this->violations;
    }

    public function setViolations($violations)
    {
        $this->violations = $violations;
    }


}