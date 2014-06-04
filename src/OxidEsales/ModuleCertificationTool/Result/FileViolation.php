<?php
/**
 *    This file is part of the OXID module certification tool
 *    The OXID module certification tool is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *    The OXID module certification tool is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *    For further details, see <http://www.gnu.org/licenses/>.
 *
 * @link          http://www.oxid-esales.com
 * @package       OXID module certification tool
 * @copyright (C) OXID eSales AG 2003-2014
 */

namespace OxidEsales\ModuleCertificationTool\Result;

/**
 * Class FileViolation:
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class FileViolation
{

    /**
     * @var string The filename containing the class with the violation.
     */
    private $fileName;

    /**
     * @var string The class containing the violation.
     */
    private $class;

    /**
     * @var string The mothod containing the violation.
     */
    private $method;

    /**
     * @var int The first line of the method containing the violation.
     */
    private $beginLine;

    /**
     * @var int The last line of the method containing the violation.
     */
    private $endLine;

    /**
     * @var string The rule that has been violated.
     */
    private $rule;

    /**
     * Get the file name where the violation occurs.
     *
     * @return string The file name for the class that violates the rule
     */
    public function getFile()
    {
        return $this->fileName;
    }

    /**
     * Set the file name where the violation occurs.
     *
     * @param string $fileName The file name for the class that violates the rule
     *
     * @return null
     */
    public function setFile( $fileName )
    {
        $this->fileName = $fileName;
    }

    /**
     * Get the class name where the violation occurs.
     *
     * @return string The name of the class that violates the rule
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the class name where the violation occurs.
     *
     * @param string $class The name of the class that violates the rule
     *
     * @return null
     */
    public function setClass( $class )
    {
        $this->class = $class;
    }

    /**
     * Get the method name where the violation occurs.
     *
     * @return string The name of the method that violates the rule
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the method name where the violation occurs.
     *
     * @param string $method The name of the method that violates the rule
     *
     * @return null
     */
    public function setMethod( $method )
    {
        $this->method = $method;
    }

    /**
     * Get the line number where violation starts.
     *
     * @return string Number of first line of the violation
     */
    public function getBeginLine()
    {
        return $this->beginLine;
    }

    /**
     * Set the line number where violation starts.
     *
     * @param string $beginLine Number of first line of the violation
     *
     * @return null
     */
    public function setBeginLine( $beginLine )
    {
        $this->beginLine = $beginLine;
    }

    /**
     * Get the line number where violation ends.
     *
     * @return string Number of last line of the violation
     */
    public function getEndLine()
    {
        return $this->endLine;
    }

    /**
     * Set the line number where violation ends.
     *
     * @param string $endLine Number of last line of the violation
     *
     * @return null
     */
    public function setEndLine( $endLine )
    {
        $this->endLine = $endLine;
    }

    /**
     * Get the rule the has been violated.
     *
     * @return string The rule Name
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * Set the rule the has been violated.
     *
     * @param string $rule Name of violated rule
     *
     * @return null
     */
    public function setRule( $rule )
    {
        $this->rule = $rule;
    }
}
