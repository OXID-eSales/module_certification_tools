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

class MainController {

    /**
     * @var object
     */
    protected $_oConfiguration;

    public function setConfiguration( $aConfiguration ) {
        $this->_oConfiguration = (object) $aConfiguration;

        return $this;
    }

    public function indexAction() {
        $oView = new View();
        $oView->setTemplate( 'index' );

        $oController = new MdXmlController();
        $sMdHtml = $oController->setXmlFile( $this->_oConfiguration->sMdXmlFile )
                               ->getHtml();

        $sHtml = $oView->assignVariable( 'oModules', array( $sMdHtml ) )->render();

        file_put_contents( $this->_oConfiguration->sOutputFile, $sHtml );

        return $this;
    }

}
