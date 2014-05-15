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

class MdXmlModel {

    protected $_oXml = null;

    public function loadXmlFile( $sFilename ) {
        $this->_oXml = simplexml_load_file( $sFilename );

        return $this;
    }

    public function getViolations() {
        $aViolations = array();

        foreach( $this->_oXml->file as $file ) {
            $sName = (string) $file[ 'name' ];

            foreach( $file->violation as $violation ) {
                $oViolation = new Violation();

                $oViolation->setFile( $sName )
                           ->setType( (string) $violation[ 'rule' ] )
                           ->addInformation( 'Begin', (int) $violation[ 'beginline' ] )
                           ->addInformation( 'End', (int) $violation[ 'endline' ] )
                           ->addInformation( 'Package', (string) $violation[ 'package' ] )
                           ->addInformation( 'Class', (string) $violation[ 'class' ] )
                           ->addInformation( 'Method', (string) $violation[ 'method' ] )
                           ->setMessage( trim( (string) $violation ) );

                $aViolations[] = $oViolation;
            }
        }

        return $aViolations;
    }
}
