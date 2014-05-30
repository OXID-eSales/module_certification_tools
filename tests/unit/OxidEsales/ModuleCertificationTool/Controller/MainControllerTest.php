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

namespace OxidEsales\ModuleCertificationTool\Controller;

use PHPUnit_Framework_TestCase;
use OxidEsales\ModuleCertificationTool\Controller\MainController;

class MainControllerTest extends PHPUnit_Framework_TestCase
{

    /**
     * Tests the getter of violations.
     *
     * @return null
     */
    public function testSetConfiguration(){
        $configuration = array(
            'modulePath'      => 'demoModule/',
            'mdXmlFile'       => 'unit/testdata/oxmd-result.xml',
            'outputFile'      => 'unit/testdata/report.html',
            'additionalTests' => array( 'Directories' => 'unit/testdata/directory.xml',
                                        'Globals'     => 'unit/testdata/globals.xml',
                                        'Prefixes'    => 'unit/testdata/prefix.xml' )
        );

        $controller = new MainController();
        $returnObject = $controller->setConfiguration( $configuration );
        $this->assertInstanceOf('OxidEsales\ModuleCertificationTool\Controller\MainController', $returnObject);

    }


    public function testIndexAction() {
        $configuration = array(
            'modulePath'      => 'demoModule/',
            'mdXmlFile'       => 'unit/testdata/oxmd-result.xml',
            'outputFile'      => 'unit/testdata/report.html',
            'additionalTests' => array( 'Directories' => 'unit/testdata/directory.xml',
                                        'Globals'     => 'unit/testdata/globals.xml',
                                        'Prefixes'    => 'unit/testdata/prefix.xml' )
        );

        $controller = new MainController();
        $returnObject = $controller->setConfiguration( $configuration )->indexAction();
        $this->assertInstanceOf('OxidEsales\ModuleCertificationTool\Controller\MainController', $returnObject);
    }

    public function testIndexActionWrongModulePath() {
        $this->setExpectedException( '\\Exception' );

        $configuration = array(
            'modulePath'      => 'xxx',
            'mdXmlFile'       => 'unit/testdata/oxmd-result.xml',
            'outputFile'      => 'unit/testdata/report.html',
            'additionalTests' => array( 'Directories' => 'unit/testdata/directory.xml',
                                        'Globals'     => 'unit/testdata/globals.xml',
                                        'Prefixes'    => 'unit/testdata/prefix.xml' )
        );

        $controller = new MainController();
        $returnObject = $controller->setConfiguration( $configuration )->indexAction();
    }

    public function testIndexActionWrongMdXmlFilePath() {
        $this->setExpectedException( '\\Exception' );

        $configuration = array(
            'modulePath'      => 'demoModule/',
            'mdXmlFile'       => 'xxx',
            'outputFile'      => 'unit/testdata/report.html',
            'additionalTests' => array( 'Directories' => 'unit/testdata/directory.xml',
                                        'Globals'     => 'unit/testdata/globals.xml',
                                        'Prefixes'    => 'unit/testdata/prefix.xml' )
        );

        $controller = new MainController();
        $returnObject = $controller->setConfiguration( $configuration )->indexAction();
    }

    public function testIndexActionWrongOutputFilePath() {
        $this->setExpectedException( '\\Exception' );

        $configuration = array(
            'modulePath'      => 'demoModule/',
            'mdXmlFile'       => 'unit/testdata/oxmd-result.xml',
            'outputFile'      => '',
            'additionalTests' => array( 'Directories' => 'unit/testdata/directory.xml',
                                        'Globals'     => 'unit/testdata/globals.xml',
                                        'Prefixes'    => 'unit/testdata/prefix.xml' )
        );

        $controller = new MainController();
        $returnObject = $controller->setConfiguration( $configuration )->indexAction();
    }

    public function testIndexActionWrongDirectoryXmlPath() {
        $this->setExpectedException( '\\Exception' );

        $configuration = array(
            'modulePath'      => 'demoModule/',
            'mdXmlFile'       => 'unit/testdata/oxmd-result.xml',
            'outputFile'      => 'unit/testdata/report.html',
            'additionalTests' => array( 'Directories' => 'xxx',
                                        'Globals'     => 'unit/testdata/globals.xml',
                                        'Prefixes'    => 'unit/testdata/prefix.xml' )
        );

        $controller = new MainController();
        $returnObject = $controller->setConfiguration( $configuration )->indexAction();
    }

    public function testIndexActionWrongGlobalsXmlPath() {
        $this->setExpectedException( '\\Exception' );

        $configuration = array(
            'modulePath'      => 'demoModule/',
            'mdXmlFile'       => 'unit/testdata/oxmd-result.xml',
            'outputFile'      => 'unit/testdata/report.html',
            'additionalTests' => array( 'Directories' => 'unit/testdata/directory.xml',
                                        'Globals'     => 'xxx',
                                        'Prefixes'    => 'unit/testdata/prefix.xml' )
        );

        $controller = new MainController();
        $returnObject = $controller->setConfiguration( $configuration )->indexAction();
    }

    public function testIndexActionWrongPrefixXmlPath() {
        $this->setExpectedException( '\\Exception' );

        $configuration = array(
            'modulePath'      => 'demoModule/',
            'mdXmlFile'       => 'unit/testdata/oxmd-result.xml',
            'outputFile'      => 'unit/testdata/report.html',
            'additionalTests' => array( 'Directories' => 'unit/testdata/directory.xml',
                                        'Globals'     => 'unit/testdata/globals.xml',
                                        'Prefixes'    => 'xxx' )
        );

        $controller = new MainController();
        $returnObject = $controller->setConfiguration( $configuration )->indexAction();
    }

}
