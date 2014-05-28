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

class CertificationRuleTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test setter and getter of violated flag.
     *
     * @return  null
     */
    public function testSetGetIsViolated()
    {
        $certificationRule = new CertificationRule();
        $this->assertFalse( $certificationRule->getViolated() );

        $certificationRule->setViolated( true );
        $this->assertTrue( $certificationRule->getViolated() );
    }

    /**
     * Test setter and getter of name.
     *
     * @return  null
     */
    public function testSetGetName()
    {
        $value = 'name';

        $certificationRule = new CertificationRule();
        $certificationRule->setName( $value );

        $this->assertEquals( $value, $certificationRule->getName() );
    }

    /**
     * Test setter and getter of threshold.
     *
     * @return  null
     */
    public function testSetGetThreshold()
    {
        $value = 25;

        $certificationRule = new CertificationRule();
        $certificationRule->setThreshold( $value );

        $this->assertEquals( $value, $certificationRule->getThreshold() );
    }

    /**
     * Test setter and getter of value.
     *
     * @return  null
     */
    public function testSetGetValue()
    {
        $value = 5;

        $certificationRule = new CertificationRule();
        $certificationRule->setValue( $value);

        $this->assertEquals( $value, $certificationRule->getValue() );
    }

    /**
     * Test setter and getter of .
     *
     * @return  null
     */
    public function testSetGetFactor()
    {
        $value = 1.75;

        $certificationRule = new CertificationRule();
        $certificationRule->setFactor( $value );

        $this->assertEquals( $value, $certificationRule->getFactor() );
    }

    /**
     * Test setter and getter of .
     *
     * @return  null
     */
    public function testSetGetViolations()
    {
        $value = array( 1, 2, 3, 'hossa' );

        $certificationRule = new CertificationRule();
        $certificationRule->setViolations( $value );

        $this->assertEquals( $value, $certificationRule->getViolations() );
    }

    /**
     * Set up test environment
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down test environment
     *
     * @return null
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
