<?php


namespace Com\OxidEsales\ModuleCertificationTool\Model;


class CertificationRule
{

    /**
     * @var bool
     */
    private $bViolated;

    /**
     * @var string
     */
    private $sName;

    /**
     * @var int
     */
    private $iThreshold;

    /**
     * @var int
     */
    private $iValue;

    /**
     * @var float
     */
    private $fFactor;

    /**
     * @param float $factor
     */
    public function setFactor( $factor )
    {
        $this->fFactor = $factor;
    }

    /**
     * @return float
     */
    public function getFactor()
    {
        return $this->fFactor;
    }

    /**
     * @param string $name
     */
    public function setName( $name )
    {
        $this->sName = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->sName;
    }

    /**
     * @param int $threshold
     */
    public function setThreshold( $threshold )
    {
        $this->iThreshold = $threshold;
    }

    /**
     * @return int
     */
    public function getThreshold()
    {
        return $this->iThreshold;
    }

    /**
     * @param int $value
     */
    public function setValue( $value )
    {
        $this->iValue = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->iValue;
    }

    /**
     * @param boolean $violated
     */
    public function setViolated( $violated )
    {
        $this->bViolated = $violated;
    }

    /**
     * @return boolean
     */
    public function getViolated()
    {
        return $this->bViolated;
    }

} 