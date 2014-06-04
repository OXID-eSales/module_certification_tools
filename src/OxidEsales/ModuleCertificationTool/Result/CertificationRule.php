<?php
/**
 *    This file is part of the OXID module certification tool
 *    The OXID module certification tool is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *    The OXID module certification tool is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *    For further details, see <http://www.gnu.org/licenses/>.
 *
 * @link          http://www.oxid-esales.com
 * @package       OXID module certification tool
 * @copyright (C) OXID eSales AG 2003-2014
 */

namespace OxidEsales\ModuleCertificationTool\Result;

/**
 * Class CertificationRule: This class is a data container holding information about violations that occur,
 * name of rule, threshold, actual value und factor for price calculation.
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class CertificationRule
{

    /**
     * @var bool Flag that shows if a violation occur.
     */
    private $violated = false;

    /**
     * @var string Name of rule
     */
    private $name = '';

    /**
     * @var int Max allowed value for rule
     */
    private $threshold = null;

    /**
     * @var int Actual value for rule
     */
    private $value = null;

    /**
     * @var float Factor to multiply base price with
     */
    private $factor = 1;

    /**
     * @var array Array of violations
     */
    private $violations = array();

    /**
     * Set the factor to multiply base price with.
     *
     * @param float $factor The factor
     *
     * @return null
     */
    public function setFactor( $factor )
    {
        $this->factor = $factor;
    }

    /**
     * Get the factor.
     *
     * @return float Factor
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * Set the name of certification rule.
     *
     * @param string $name Certification rule name.
     *
     * @return null
     */
    public function setName( $name )
    {
        $this->name = $name;
    }

    /**
     * Get the name of certification rule.
     *
     * @return string $name Certification rule name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the threshold for this current rule.
     *
     * @param int $threshold Max allowed value for rule
     *
     * @return null
     */
    public function setThreshold( $threshold )
    {
        $this->threshold = $threshold;
    }

    /**
     * Get the threshold for this rule.
     *
     * @return int Max allowed value
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * Set the current value for this rule.
     *
     * @param int $value Actual value
     *
     * @return null
     */
    public function setValue( $value )
    {
        $this->value = $value;
    }

    /**
     * Get the actual value for this rule.
     *
     * @return int Actual value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the flag to true if rule is violated.
     *
     * @param boolean $violated.
     *
     * @return null
     */
    public function setViolated( $violated )
    {
        $this->violated = $violated;
    }

    /**
     * Get information if a violation occur.
     *
     * @return boolean True if there was a violation.
     */
    public function getViolated()
    {
        return $this->violated;
    }

    /**
     * Get all violations.
     *
     * @return CertificationRuleViolation[]
     */
    public function getViolations()
    {
        return $this->violations;
    }

    /**
     * Set all violations.
     *
     * @param CertificationRuleViolation[] $violations
     *
     * @return null
     */
    public function setViolations( $violations )
    {
        $this->violations = $violations;
    }
}
