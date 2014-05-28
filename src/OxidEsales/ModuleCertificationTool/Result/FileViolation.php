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

    public function getFile()
    {
        return $this->fileName;
    }

    public function setFile($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getBeginLine()
    {
        return $this->beginLine;
    }

    public function setBeginLine($beginLine)
    {
        $this->beginLine = $beginLine;
    }

    public function setEndLine($endLine)
    {
        $this->endLine = $endLine;
    }

    public function getRule()
    {
        return $this->rule;
    }

    public function setRule($rule)
    {
        $this->rule = $rule;
    }
}
