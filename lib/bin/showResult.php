<?php

require_once '../src/MdXmlDataExtractor.php';
require_once '../src/Violation.php';

$x = new MdXmlDataExtractor();
$x->loadXmlFile( '../../data/report.xml' )->getFailures();
