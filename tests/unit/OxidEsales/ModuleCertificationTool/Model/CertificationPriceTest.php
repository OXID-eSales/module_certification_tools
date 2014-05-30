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

namespace OxidEsales\ModuleCertificationTool\Model;

use OxidEsales\ModuleCertificationTool\Result\CertificationResult;
use OxidEsales\ModuleCertificationTool\Result\CertificationRule;
use PHPUnit_Framework_TestCase;

class CertificationPriceTest extends PHPUnit_Framework_TestCase
{
    private $htmlOutput = <<<EOF
<div class="page-header">
    <h2>Certification Price</h2>
</div>

<div class="alert alert-info">Please note that the listed price is only an estimate. The actual price depends on the
manual investigation of your module and might differ significantly.</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Metrics</h3>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Remark</th>
            <th class="text-right">Value</th>
            <th class="text-right">Factor</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Code Coverage</td>
            <td>Has to be > 90%. Values below result in manual work when testing.</td>
            <td class="text-right">10%</td>
            <td class="text-right">1.25</td>
        </tr>
        <tr>
            <td>C.R.A.P Index</td>
            <td>The Change Risk Analysis and Predictions (CRAP) index of a function or method uses cyclomatic complexity and code coverage from automated tests to help estimate the effort and risk associated with maintaining legacy code. A CRAP index over 30 is a good indicator of crappy code.</td>
            <td class="text-right">20</td>
            <td class="text-right">1.5</td>
        </tr>
        <tr>
            <td>NPath Complexity</td>
            <td>The NPATH metric computes the number of possible execution paths through a function. It takes into account the nesting of conditional statements and multi-part boolean expressions (e.g., A && B, C || D, etc.).
                A NPATH Complexity over 200 is a good candidate for a closer decomposition.</td>
            <td class="text-right">40</td>
            <td class="text-right">2</td>
        </tr>
        <tr>
            <td>Cyclomatic Complexity</td>
            <td>Checks cyclomatic complexity against a specified limit. The complexity is measured by the number of if, while, do, for, ?:, catch, switch, case  statements, and operators && and || (plus one) in the body of a constructor, method, static initializer, or instance initializer. It is a measure of the minimum number of possible paths through the source and therefore the number of required tests. Generally 1-4 is considered good, 5-7 ok, 8-10 consider re-factoring, and 11+ re-factor now!</td>
            <td class="text-right">30</td>
            <td class="text-right">1.75</td>
        </tr>
        <tr>
            <td colspan="3"><b>Total Factor</b></td>
            <td class="text-right"><b></b></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Price</h3>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Type</th>
            <th>Remark</th>
            <th class="text-right">Value</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Basic factor price</td>
            <td>The basic factor price is multiplied by the determined software quality factor.</td>
            <td class="text-right">119,00&euro;</td>
        </tr>
        <tr>
            <td>Total factor price</td>
            <td>Multiply basic factor price by the total factor price</td>
            <td class="text-right">0,00&euro;</td>
        </tr>
        <!--        <tr>-->
        <!--            <td>Basic price software quality</td>-->
        <!--            <td>Per certification attempt (or check for attempt or pre-check). 1 feedback cycle included.</td>-->
        <!--            <td>250€</td>-->
        <!--        </tr>-->
        <!--        <tr>-->
        <!--            <td>Certification flat charge</td>-->
        <!--            <td>This covers technical code reviewing and module testing based on OXID eSales module certification rules (OXID_Module_Certification_Rules.pdf)</td>-->
        <!--            <td>960&euro;</td>-->
        <!--        </tr>-->
        <tr>
            <td colspan="2"><b>Total Certification Price</b></td>
            <td class="text-right"><b>0,00&euro;</b></td>
        </tr>
        </tbody>
    </table>
</div>
EOF;


    /**
     * Test that certificationPrice object is set correct.
     *
     * @return null
     */
    public function testGetResult()
    {
        $certificationResult = $this->prepareCertificationResult();
        $certificationPrice  = new CertificationPrice( $certificationResult );

        $this->assertEquals( $certificationResult, $certificationPrice->getResult() );
    }

    public function testGetHtml()
    {
        $certificationResult = $this->prepareCertificationResult();
        $certificationPrice  = new CertificationPrice( $certificationResult );

        $this->assertEquals( $this->htmlOutput, $certificationPrice->getHtml() );
    }

    /**
     * Prepare the result array containing one of each rule.
     *
     * @return CertificationResult
     */
    private function prepareCertificationResult()
    {
        $certificationRules = array();

        $codeCoverageRule = new CertificationRule();
        $codeCoverageRule->setValue( 10 );
        $codeCoverageRule->setFactor( 1.25 );
        $certificationRules[ 'Code Coverage' ] = $codeCoverageRule;

        $crapRule = new CertificationRule();
        $crapRule->setValue( 20 );
        $crapRule->setFactor( 1.5 );
        $certificationRules[ 'C.R.A.P Index' ] = $crapRule;

        $cyclomaticRule = new CertificationRule();
        $cyclomaticRule->setValue( 30 );
        $cyclomaticRule->setFactor( 1.75 );
        $certificationRules[ 'Cyclomatic Complexity' ] = $cyclomaticRule;

        $nPathRule = new CertificationRule();
        $nPathRule->setValue( 40 );
        $nPathRule->setFactor( 2 );
        $certificationRules[ 'NPath Complexity' ] = $nPathRule;

        $certificationResult = new CertificationResult();
        $certificationResult->setCertificationRules( $certificationRules );

        return $certificationResult;
    }
}
