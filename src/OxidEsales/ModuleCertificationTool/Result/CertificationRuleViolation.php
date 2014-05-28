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
 * Class CertificationRuleViolation: Data container that holds the data for violated rules.
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class CertificationRuleViolation
{
    /**
     * @var string The file name where violation occur.
     */
    private $file;

    /**
     * @var int Line number of violation.
     */
    private $line;

    /**
     * @var string Violated class name.
     */
    private $class;

    /**
     * @var string Method that has a violation.
     */
    private $method;

    /**
     * @var string Namespace of class that is violated.
     */
    private $namespace;

    /**
     * Set the name of class that has a violation.
     *
     * @param string $class Name of class
     *
     * @return null
     */
    public function setClass( $class )
    {
        $this->class = $class;
    }

    /**
     * Get the name of class that has a violation.
     *
     * @return string Name of class
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the name of file that has a violation.
     *
     * @param string $file File name to set.
     *
     * @return null
     */
    public function setFile( $file )
    {
        $this->file = $file;
    }

    /**
     * Set the nome of violated file.
     *
     * @return string Name of file.
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the line number where violation occur.
     *
     * @param int $line Number of violated line.
     *
     * @return null
     */
    public function setLine( $line )
    {
        $this->line = $line;
    }

    /**
     * Set the line number where violation occur.
     *
     * @return int Number of violated line.
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set the name of method that has a violation.
     *
     * @param string $method  Name of method
     *
     * @return null
     */
    public function setMethod( $method )
    {
        $this->method = $method;
    }

    /**
     * Get the name of method that has a violation.
     *
     * @return string Method name
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the namespace of class that has a violation.
     *
     * @param string $namespace Namespace
     *
     * @return null
     */
    public function setNamespace( $namespace )
    {
        $this->namespace = $namespace;
    }

    /**
     * Get the namespace of class that has a violation.
     *
     * @return string Namespace
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
}
