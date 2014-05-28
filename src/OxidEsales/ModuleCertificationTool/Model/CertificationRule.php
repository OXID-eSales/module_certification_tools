<?php
/**
 *    This file is part of the OXID module certification tool
 *
 *    The OXID module certification tool is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The OXID module certification tool is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    For further details, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @package   OXID module certification tool
 * @copyright (C) OXID eSales AG 2003-2014
 */


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
