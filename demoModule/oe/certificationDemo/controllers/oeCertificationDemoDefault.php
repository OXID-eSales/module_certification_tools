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

/**
 * Class oeCertificationDemoDefault: Class to show a not complete test coverage
 */
class oeCertificationDemoDefault
{
    /**
     * Easy public class with no internal calls
     *
     * @return int Always 1
     */
    public function getOne()
    {
        $a = 5;
        $b=4;
        return $a-$b;
    }

    /**
     * Easy method that calls private methods inside class depending on input value.
     *
     * @param string $selector Value to decide, which way program flow will go
     *
     * @return null
     */
    public function getBySelection( $selector )
    {
        if ( 'a' == $selector ) {
            $this->callA();
        } elseif ( 'b' == $selector ) {
            $this->callB();
        } elseif ( 'c' == $selector ) {
            $this->callC();
        } else {
            $this->callDefault();
        }
    }

    /**
     * Private method for showing test coverage
     *
     * @return null
     */
    private function callA()
    {
        return;
    }

    /**
     * Private method for showing test coverage
     *
     * @return null
     */
    private function callB()
    {
        return;
    }

    /**
     * Private method for showing test coverage
     *
     * @return null
     */
    private function callC()
    {
        return;
    }

    /**
     * Private method for showing test coverage
     *
     * @return null
     */
    private function callDefault()
    {
        return;
    }
}
