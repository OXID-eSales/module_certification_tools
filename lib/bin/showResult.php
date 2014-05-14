<?php

require_once '../src/MdXmlController.php';
require_once '../src/MdXmlModel.php';
require_once '../src/Violation.php';
require_once '../src/View.php';
require_once '../src/MainController.php';

$aConfiguration = array(
    'sMdXmlFile'  => '../../data/report.xml',
    'sOutputFile' => '../../output/report.html'
);

$oController = new MainController();
$oController->setConfiguration( $aConfiguration )->indexAction();

