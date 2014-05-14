<?php

class MainController {

    /**
     * @var object
     */
    protected $_oConfiguration;

    public function setConfiguration( $aConfiguration ) {
        $this->_oConfiguration = (object) $aConfiguration;

        return $this;
    }

    public function indexAction() {
        $oView = new View();
        $oView->setTemplate( 'index' );

        $oController = new MdXmlController();
        $sMdHtml = $oController->setXmlFile( $this->_oConfiguration->sMdXmlFile )
                               ->getHtml();

        $sHtml = $oView->assignVariable( 'oModules', array( $sMdHtml ) )->render();

        file_put_contents( $this->_oConfiguration->sOutputFile, $sHtml );

        return $this;
    }

} 