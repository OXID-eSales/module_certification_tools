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

use PHPUnit_Framework_TestCase;

/**
 * Class CertificationResultTest
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class CertificationResultTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test setter and getter of .
     */
    public function testSetGetFactor()
    {
        $value = 1.75;

        $result = new CertificationResult();
        $result->setFactor( $value );

        $this->assertEquals( $value, $result->getFactor() );
    }

    /**
     * Test setter and getter of .
     */
    public function testSetGetPrice()
    {
        $value = 12345.67;

        $result = new CertificationResult();
        $result->setPrice( $value );

        $this->assertEquals( $value, $result->getPrice() );
    }

    /**
     * Test setter and getter of certification rules array.
     */
    public function testSetGetCertificationRules()
    {
        $value = array( 'rule1' => 'eins', 'rule2' => 'zwei', 'rule...' => 'rule...' );

        $result = new CertificationResult();
        $result->setCertificationRules( $value );

        $this->assertEquals( $value, $result->getCertificationRules() );
    }

    /**
     * Test getter of certification rule by name.
     */
    public function testSetGetCertificationRule()
    {
        $value = array( 'rule1' => 'eins', 'rule2' => 'zwei', 'rule...' => 'rule...' );
        $name  = 'rule2';

        $result = new CertificationResult();
        $result->setCertificationRules( $value );

        $this->assertEquals( $value[ $name ], $result->getCertificationRule( $name ) );
    }

    /**
     * Test setter and getter of .
     */
    public function testSetGet()
    {
        $value = array( 'violations' );

        $result = new CertificationResult();
        $result->setViolations( $value );

        $this->assertEquals( $value, $result->getViolations() );
    }
}
