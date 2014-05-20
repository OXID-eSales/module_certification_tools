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
 * Class Violation a data holding class for the violations of rules
 */
class Violation {

    /**
     * Contains a detailed message for the ruel violation.
     *
     * @var string
     */
    protected $_sMessage = '';

    /**
     * Contains the type of rule violation.
     *
     * @var string
     */
    protected $_sType = '';

    /**
     * Contains the file tha violated the rule.
     *
     * @var string
     */
    protected $_sFile = '';

    /**
     * Contains an array with additional informations.
     *
     * @var array
     */
    protected $_aInformation = array();

    /**
     * Setter for the Message.
     *
     * @param string $sMessage message to set
     *
     * @return $this the object itself
     */
    public function setMessage( $sMessage ) {
        $this->_sMessage = $sMessage;

        return $this;
    }

    /**
     * Getter for the message.
     *
     * @return string the stored message
     */
    public function getMessage() {
        return $this->_sMessage;
    }

    /**
     * Setter for violation type.
     *
     * @param string $sType the type to set.
     *
     * @return $this the object itself
     */
    public function setType( $sType ) {
        $this->_sType = $sType;

        return $this;
    }

    /**
     * Getter for the violation type.
     *
     * @return string the type of violation
     */
    public function getType() {
        return $this->_sType;
    }

    /**
     * Setter for the violating file.
     *
     * @param string $sFile the file that violates the rule
     *
     * @return $this the object itself
     */
    public function setFile( $sFile ) {
        $this->_sFile = $sFile;

        return $this;
    }

    /**
     * Getter for the violating file.
     *
     * @return string the file that violates the rule
     */
    public function getFile() {
        return $this->_sFile;
    }

    /**
     * Adds special information to the violation object.
     *
     * @param string $sType the type of additional information
     * @param mixed $xInformation the information to be stored
     *
     * @return $this the object itself
     */
    public function addInformation( $sType, $xInformation ) {
        $this->_aInformation[ $sType ] = $xInformation;

        return $this;
    }

    /**
     * Gets additional information for a special information type.
     *
     * @param string $sType the type of additional information to get
     *
     * @return mixed the stored additional information
     */
    public function getInformation( $sType ) {
        return $this->_aInformation[ $sType ];
    }

}
