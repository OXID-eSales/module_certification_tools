<?php

class MdXmlDataExtractor {

    protected $_oXml = null;

    public function loadXmlFile( $sFilename ) {
        $this->_oXml = simplexml_load_file( $sFilename );

        return $this;
    }

    public function getFailures() {
        $aViolations = array();

        foreach( $this->_oXml->file as $file ) {
            $sName = (string) $file[ 'name' ];

            foreach( $file->violation as $violation ) {
                $oViolation = new Violation();

                $oViolation->addFile( $sName )
                           ->addType( (string) $violation[ 'rule' ] )
                           ->addInformation( 'Begin', (int) $violation[ 'beginline' ] )
                           ->addInformation( 'End', (int) $violation[ 'endline' ] )
                           ->addInformation( 'Package', (string) $violation[ 'package' ] )
                           ->addInformation( 'Class', (string) $violation[ 'class' ] )
                           ->addInformation( 'Method', (string) $violation[ 'method' ] )
                           ->addMessage( trim( (string) $violation ) );

                $aViolations[] = $oViolation;
            }
        }

        var_dump($aViolations);
    }
}
