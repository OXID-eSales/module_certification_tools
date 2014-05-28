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
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */

    private $class;
    /**
     * @var string
     */

    private $method;
    /**
     * @var int
     */

    private $beginLine;
    /**
     * @var int
     */

    private $endLine;

    /**
     * @var string
     */
    private $rule;

    /**
     * Get the file name where violation occur.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->fileName;
    }

    /**
     * Set the file name where´a violation occur
     *
     * @param string $fileName
     *
     * @return null
     */
    public function setFile( $fileName )
    {
        $this->fileName = $fileName;
    }

    /**
     * Get the class name where violation occur.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the class name where violation occur.
     *
     * @param string $class Name of class violation occur.
     *
     * @return null
     */
    public function setClass( $class )
    {
        $this->class = $class;
    }

    /**
     * Get the method name where violation occur.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the method name where violation occur.
     *
     * @param string $method Name of method violation occur.
     *
     * @return null
     */
    public function setMethod( $method )
    {
        $this->method = $method;
    }

    /**
     * Get the line number where violation start.
     *
     * @return string
     */
    public function getBeginLine()
    {
        return $this->beginLine;
    }

    /**
     * Set the line number where violation starts.
     *
     * @param string $beginLine Number of first line violation occur.
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
     * @return string
     */
    public function getEndLine()
    {
        return $this->endLine;
    }

    /**
     * Set the line number where violation ends.
     *
     * @param string $endLine Number of last line violation occur.
     *
     * @return null
     */
    public function setEndLine( $endLine )
    {
        $this->endLine = $endLine;
    }

    /**
     * Get the violated rule name.
     *
     * @return string
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * Set the violated rule name.
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
