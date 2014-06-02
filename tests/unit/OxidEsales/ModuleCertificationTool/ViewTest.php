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

namespace OxidEsales\ModuleCertificationTool;

use PHPUnit_Framework_TestCase;

class ViewTest extends PHPUnit_Framework_TestCase
{
    private $htmlOutput = <<<EOF
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../resource/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../resource/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../../resource/css/custom.css">
        <script src="../../resource/js/jquery.min.js"></script>
        <script src="../../resource/js/bootstrap.min.js"></script>
        <!--[if lt IE 9]>
        <script src="../../resource/js/html5shiv.js"></script>
        <script src="../../resource/js/respond.min.js"></script>
        <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OXID Module Certification Result</title>
    </head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="../../resource/image/logo.png" /> Module Certification Tool</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#price">Pricing</a></li>
                    <li><a href="#violations">Violations</a></li>
                    <li><a href="#checks">Generic Checks</a></li>
                </ul>
            </div>
        </div>
    </nav>
        <div class="container">

            <div id="price">
                Test            </div>

            <div id="violations">
                <div class="page-header">
                    <h2>Violations</h2>
                </div>
                            </div>

            <div id="checks">
                <div class="page-header">
                    <h2>Generic Checks</h2>
                </div>
                            </div>
        </div>
    </body>
</html>

EOF;

    public function testRendering() {
        $testObject = new View();
        $html = $testObject->setTemplate( 'index' )
                           ->assignVariable( 'certificationResult', 'Test' )
                           ->assignVariable( 'fileViolations', array() )
                           ->assignVariable( 'genericChecks', array() )
                           ->render();

        $this->assertEquals( $this->htmlOutput, $html );
    }

    public function testRenderingWithoutTemplate() {
        $this->setExpectedException( '\\Exception' );
        $testObject = new View();
        $html = $testObject->render();

    }

    public function testRenderingWithWrongTemplate() {
        $this->setExpectedException( '\\Exception' );
        $testObject = new View();
        $html = $testObject->setTemplate( 'blablubb' )
                           ->render();
    }

}
