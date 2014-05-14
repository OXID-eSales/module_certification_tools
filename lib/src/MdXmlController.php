<?php

class MdXmlController {

    protected $_sFilePath = '';

    public function getHtml() {
        $oModel = new MdXmlModel();
        $aViolations = $oModel->loadXmlFile( $this->_sFilePath )->getViolations();

        $oView = new View();
        $sHtml = $oView->setTemplate( 'mdTable' )
                       ->assignVariable( 'aViolations', $aViolations )
                       ->render();

        return $sHtml;
    }

    public function setXmlFile( $sFilePath ) {
        $this->_sFilePath = $sFilePath;

        return $this;
    }
}