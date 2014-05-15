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

class Violation {

    /**
     * @var string
     */
    protected $_sMessage = '';

    /**
     * @var string
     */
    protected $_sType = '';

    /**
     * @var string
     */
    protected $_sFile = '';

    /**
     * @var array
     */
    protected $_aInformation = array();

    /**
     * @param string $sMessage
     *
     * @return $this
     */
    public function setMessage( $sMessage ) {
        $this->_sMessage = $sMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage() {
        return $this->_sMessage;
    }

    /**
     * @param string $sType
     *
     * @return $this
     */
    public function setType( $sType ) {
        $this->_sType = $sType;

        return $this;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->_sType;
    }

    /**
     * @param string $sFile
     *
     * @return $this
     */
    public function setFile( $sFile ) {
        $this->_sFile = $sFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getFile() {
        return $this->_sFile;
    }

    /**
     * @param string $sType
     * @param string $sInformation
     *
     * @return $this
     */
    public function addInformation( $sType, $sInformation ) {
        $this->_aInformation[ $sType ] = $sInformation;

        return $this;
    }

    /**
     * @param string $sType
     *
     * @return string
     */
    public function getInformation( $sType ) {
        return $this->_aInformation[ $sType ];
    }

}
