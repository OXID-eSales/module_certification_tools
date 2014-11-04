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

namespace OxidEsales\ModuleCertificationTool\Result;

/**
 * Class Violation: A data holding class for the violations of rules.
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class GenericViolation
{

    /**
     * @var string Contains a detailed message for the rule violation.
     */
    protected $message = '';

    /**
     * @var string Contains the type of rule violation.
     */
    protected $type = '';

    /**
     * @var string Contains the file tha violated the rule.
     */
    protected $file = '';

    /**
     * @var array Contains an array with additional informations.
     */
    protected $additionalInformation = array();

    /**
     * Setter for the Message.
     *
     * @param string $message Message to set
     *
     * @return $this The object itself
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Getter for the message.
     *
     * @return string The stored message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Setter for violation type.
     *
     * @param string $type The type to set.
     *
     * @return $this The object itself
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Getter for the violation type.
     *
     * @return string The type of violation
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Setter for the violating file.
     *
     * @param string $file The file that violates the rule
     *
     * @return $this The object itself
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Getter for the violating file.
     *
     * @return string The file that violates the rule
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Adds special information to the violation object.
     *
     * @param string $type The type of additional information
     * @param mixed $information The information to be stored
     *
     * @return $this The object itself
     */
    public function addInformation($type, $information)
    {
        $this->additionalInformation[$type] = $information;

        return $this;
    }

    /**
     * Gets additional information for a special information type.
     *
     * @param string $type The type of additional information to get
     *
     * @return mixed The stored additional information
     */
    public function getInformation($type)
    {
        if (!array_key_exists($type, $this->additionalInformation)) {
            return null;
        }

        return $this->additionalInformation[$type];
    }

}
