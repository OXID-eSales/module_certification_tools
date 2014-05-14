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
    public function setMessage( $sMessage ) {
        $this->_sMessage = $sMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage() {
        return $this->_sMessage;
    }

    /**
     * @param string $sType
     *
     * @return $this
     */
    public function setType( $sType ) {
        $this->_sType = $sType;

        return $this;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->_sType;
    }

    /**
     * @param string $sFile
     *
     * @return $this
     */
    public function setFile( $sFile ) {
        $this->_sFile = $sFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getFile() {
        return $this->_sFile;
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

    /**
     * @param string $sType
     *
     * @return string
     */
    public function getInformation( $sType ) {
        return $this->_aInformation[ $sType ];
    }

} 