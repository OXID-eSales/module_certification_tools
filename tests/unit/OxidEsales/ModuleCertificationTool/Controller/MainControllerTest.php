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
        $aConfiguration = array(
            'sModulePath'      => '/var/www/htdocs/',
            'sMdXmlFile'       => '/var/www/htdocs/oxmd-result.xml',
            'sOutputFile'      => '/var/www/htdocs/report.html',
            'aAdditionalTests' => array( 'Directories' => '/var/www/htdocs/directory.xml',
                                         'Globals'     => '/var/www/htdocs/globals.xml',
                                         'Prefixes'    => '/var/www/htdocs/prefix.xml' )
        );

        $oController = new MainController();
        $returnObject = $oController->setConfiguration( $aConfiguration );
        $this->assertInstanceOf('OxidEsales\ModuleCertificationTool\Controller\MainController', $returnObject);

    }


    public function testIndexAction() {
        $aConfiguration = array(
            'sModulePath'      => '/var/www/htdocs/',
            'sMdXmlFile'       => '/var/www/htdocs/oxmd-result.xml',
            'sOutputFile'      => '/var/www/htdocs/report.html',
            'aAdditionalTests' => array( 'Directories' => '/var/www/htdocs/directory.xml',
                                         'Globals'     => '/var/www/htdocs/globals.xml',
                                         'Prefixes'    => '/var/www/htdocs/prefix.xml' )
        );

        $oController = new MainController();
        $returnObject = $oController->setConfiguration( $aConfiguration )->indexAction();
        $this->assertInstanceOf('OxidEsales\ModuleCertificationTool\Controller\MainController', $returnObject);
    }

}
