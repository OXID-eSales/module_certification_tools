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

/**
 * Class HighCrapIndex:Here a method with a C.R.A.P. index higher than 30 is created.
 * It contains a very
 */
class HighCrapIndex
{
    /**
     * Method has a cyclomatic complexity of 15, so test coverage less than 60 % will lead to a CRAP > 30
     *
     * @param bool $a
     * @param bool $b
     * @param bool $c
     * @param bool $d
     *
     * @return null
     */
    public function createHighCrap( $a = false, $b = false, $c = false, $d = false )
    {
        if ( $a ) {
            // do with $a
        } else {
            // do not $a
        }

        if ( $b ) {
            // do with $b
        } else {
            // do not $b
        }

        if ( $c ) {
            // do with $c
        } else {
            // do not $c
        }

        if ( $d ) {
            // do with $d
        } else {
            // do not $d
        }

        if ( $a || $b ) {
            // do with both
        }

        if ( $a || $c ) {
            // do with both
        }

        if ( $b || $c ) {
            // do with both
        }

        if ( $b || $d ) {
            // do with both
        }

        if ( $c || $d ) {
            // do with both
        }
    }
}
