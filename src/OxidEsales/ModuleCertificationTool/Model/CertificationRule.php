<?php


namespace OxidEsales\ModuleCertificationTool\Model;


class CertificationRule
{

    /**
     * @var bool
     */
    private $violated;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $threshold;

    /**
     * @var int
     */
    private $value;

    /**
     * @var float
     */
    private $factor;
    /**
     * @var array
     */
    private $violations;

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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $threshold
     */
    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;
    }

    /**
     * @return int
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param boolean $violated
     */
    public function setViolated($violated)
    {
        $this->violated = $violated;
    }

    /**
     * @return boolean
     */
    public function getViolated()
    {
        return $this->violated;
    }

    /**
     * @return CertificationRuleViolation[]
     */
    public function getViolations()
    {
        return $this->violations;
    }

    /**
     * @param CertificationRuleViolation[] $aViolations
     */
    public function setViolations($aViolations)
    {
        $this->violations = $aViolations;
    }

} 