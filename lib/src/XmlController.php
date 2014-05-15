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

class XmlController {

    /**
     * @var string
     */
    protected $_sXmlFile = '';

    /**
     * @var string
     */
    protected $_sHeading = '';

    /**
     * @param string $sXmlFile
     *
     * @return $this
     */
    public function setXmlFile( $sXmlFile ) {
        $this->_sXmlFile = $sXmlFile;

        return $this;
    }

    /**
     * @param string $sHeading
     *
     * @return $this
     */
    public function setHeading( $sHeading ) {
        $this->_sHeading = $sHeading;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml() {
        $oModel = new XmlModel();
        $oModel->loadXmlFile( $this->_sXmlFile );
        $oView = new View();
        $aViolations = $oModel->getViolations();
        if ( count( $aViolations ) > 0 ) {
            $sHtml = $oView->setTemplate( 'plainTable' )
                           ->assignVariable( 'aViolations', $oModel->getViolations() )
                           ->assignVariable( 'sHeading', $this->_sHeading )
                           ->render();
        }

        return $sHtml;
    }

} 