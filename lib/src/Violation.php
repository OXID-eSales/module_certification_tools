<?php

class Violation {

    /**
     * @var string
     */
    protected $_sMessage = '';

    /**
     * @var string
     */
    protected $_sType = '';

    /**
     * @var string
     */
    protected $_sFile = '';

    /**
     * @var array
     */
    protected $_aInformation = array();

    /**
     * @param string $sMessage
     *
     * @return $this
     */
    public function addMessage( $sMessage ) {
        $this->_sMessage = $sMessage;

        return $this;
    }

    /**
     * @param string $sType
     *
     * @return $this
     */
    public function addType( $sType ) {
        $this->_sType = $sType;

        return $this;
    }

    /**
     * @param string $sFile
     *
     * @return $this
     */
    public function addFile( $sFile ) {
        $this->_sFile = $sFile;

        return $this;
    }

    /**
     * @param string $sType
     * @param string $sInformation
     *
     * @return $this
     */
    public function addInformation( $sType, $sInformation ) {
        $this->_aInformation[ $sType ] = $sInformation;

        return $this;
    }

} 