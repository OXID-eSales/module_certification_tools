<?php

class MdXmlModel {

    protected $_oXml = null;

    public function loadXmlFile( $sFilename ) {
        $this->_oXml = simplexml_load_file( $sFilename );

        return $this;
    }

    public function getViolations() {
        $aViolations = array();

        foreach( $this->_oXml->file as $file ) {
            $sName = (string) $file[ 'name' ];

            foreach( $file->violation as $violation ) {
                $oViolation = new Violation();

                $oViolation->setFile( $sName )
                           ->setType( (string) $violation[ 'rule' ] )
                           ->addInformation( 'Begin', (int) $violation[ 'beginline' ] )
                           ->addInformation( 'End', (int) $violation[ 'endline' ] )
                           ->addInformation( 'Package', (string) $violation[ 'package' ] )
                           ->addInformation( 'Class', (string) $violation[ 'class' ] )
                           ->addInformation( 'Method', (string) $violation[ 'method' ] )
                           ->setMessage( trim( (string) $violation ) );

                $aViolations[] = $oViolation;
            }
        }

        return $aViolations;
    }
}
