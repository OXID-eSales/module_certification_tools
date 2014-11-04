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
 * Class GenericViolationTest: Test the getters and setters of GenericViolation class
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class GenericViolationTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test the setting and getting of message field
     *
     * @return null
     */
    public function testSetGetMessage()
    {
        $message = 'violation message';

        $violation = new GenericViolation();
        $violation->setMessage($message);
        $this->assertEquals($message, $violation->getMessage());
    }

    /**
     * Test the setting and getting of type field
     *
     * @return null
     */
    public function testSetGetType()
    {
        $type = 'violation type';

        $violation = new GenericViolation();
        $violation->setType($type);
        $this->assertEquals($type, $violation->getType());
    }

    /**
     * Test the setting and getting of message field
     *
     * @return null
     */
    public function testSetGetFile()
    {
        $file = 'violation file';

        $violation = new GenericViolation();
        $violation->setFile($file);
        $this->assertEquals($file, $violation->getFile());
    }

    /**
     * Test the setting and getting of additional information field
     */
    public function testSetGetAdditionalInformation()
    {
        $addInformation = 'additional violation information';

        $violation = new GenericViolation();
        $infoType = 'type';
        $addInfo = $violation->getInformation($infoType);
        $this->assertEmpty($addInfo);

        $violation->addInformation($infoType, $addInformation);
        $this->assertEquals($addInformation, $violation->getInformation($infoType));
    }

    /**
     * Set up test environment
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down test environment
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
