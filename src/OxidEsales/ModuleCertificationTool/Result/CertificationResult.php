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
 * Class CertificationResult: Data container hold the data for module certification price.
 * This are price and factor and the violations and rules that are violated.
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class CertificationResult
{

    /**
     * @var float Factor to multiply base price with
     */
    private $factor;

    /**
     * @var float Calculated certification price
     */
    private $price;

    /**
     * @var array() Array of rules that are violated.
     */
    private $certificationRules;

    /**
     * @var array() Array of violations, that occur.
     */
    private $violations;

    /**
     * Set the violated rules.
     *
     * @param array $certificationRules Array of rules
     *
     * @return null
     */
    public function setCertificationRules( $certificationRules )
    {
        $this->certificationRules = $certificationRules;
    }

    /**
     * Get the violated rules
     *
     * @return array Array of rules
     */
    public function getCertificationRules()
    {
        return $this->certificationRules;
    }

    /**
     * Get a rule by name
     *
     * @param string $name
     *
     * @return null|string
     */
    public function getCertificationRule( $name )
    {
        return $this->certificationRules[ $name ];
    }

    /**
     * Set the factor.
     *
     * @param float $factor Factor to set.
     *
     * @return null
     */
    public function setFactor( $factor )
    {
        $this->factor = $factor;
    }

    /**
     * Get the factor
     *
     * @return float The factor
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * Set the certification price.
     *
     * @param float $price Price to set.
     *
     * @return null
     */
    public function setPrice( $price )
    {
        $this->price = $price;
    }

    /**
     * Get the certification price.
     *
     * @return float The price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the array of violations that occur
     *
     * @return array Array of violations
     */
    public function getViolations()
    {
        return $this->violations;
    }

    /**
     * Set a array of violations.
     *
     * @param array $violations Violations to set.
     *
     * @return null
     */
    public function setViolations( $violations )
    {
        $this->violations = $violations;
    }
}
