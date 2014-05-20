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

namespace Com\OxidEsales\ModuleCertificationTool;

/**
 * Class MdXmlController controller class to handle the output of the OXMD module
 */
class MdXmlController {

    /**
     * The path to the output file of OXMD.
     *
     * @var string
     */
    protected $_sFilePath = '';

    /**
     * Returns the HTML code for the output of the OXMD file.
     *
     * @return string HTML code for the output
     */
    public function getHtml() {
        $oModel = new MdXmlModel();
        $oModel->loadXmlFile( $this->_sFilePath );
        $aViolations = $oModel->getViolations();
        $aOverview = $oModel->getOverview();

        $oView = new View();
        $sHtml = $oView->setTemplate( 'mdTable' )
                       ->assignVariable( 'aViolations', $aViolations )
                       ->assignVariable( 'aOverview', $aOverview )
                       ->render();

        return $sHtml;
    }

    /**
     * Sets the path to the output file of the OXMD module.
     *
     * @param string $sFilePath full path of the XML file
     *
     * @return $this the controller itself
     */
    public function setXmlFile( $sFilePath ) {
        $this->_sFilePath = $sFilePath;

        return $this;
    }
}
