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

/**
 * Class XmlController controller class for handling XML output file of generic check modules
 */
class XmlController {

    /**
     * Contains the path to the XML file.
     *
     * @var string
     */
    protected $_sXmlFile = '';

    /**
     * Contains the Heading should be shown in output.
     *
     * @var string
     */
    protected $_sHeading = '';

    /**
     * Sets the path of the XML file with the output.
     *
     * @param string $sXmlFile the file containing the XML output of a generic check module
     *
     * @return $this the controller itself
     */
    public function setXmlFile( $sXmlFile ) {
        $this->_sXmlFile = $sXmlFile;

        return $this;
    }

    /**
     * Sets the heading that should be shown in output.
     *
     * @param string $sHeading the heading for this XML file.
     *
     * @return $this the controller ifself
     */
    public function setHeading( $sHeading ) {
        $this->_sHeading = $sHeading;

        return $this;
    }

    /**
     * Returns the rendered HTML code with the information from the cecker module.
     *
     * @return string the HTML output corresponding to the XML file output of the module
     */
    public function getHtml() {
        $oModel = new XmlModel();
        $oModel->loadXmlFile( $this->_sXmlFile );
        $oView = new View();
        $aViolations = $oModel->getViolations();
        $sHtml = "";
        if ( count( $aViolations ) > 0 ) {
            $sHtml = $oView->setTemplate( 'plainTable' )
                           ->assignVariable( 'aViolations', $oModel->getViolations() )
                           ->assignVariable( 'sHeading', $this->_sHeading )
                           ->render();
        }

        return $sHtml;
    }

} 