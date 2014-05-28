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


namespace OxidEsales\ModuleCertificationTool\Result;


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
