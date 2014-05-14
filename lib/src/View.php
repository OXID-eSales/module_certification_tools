<?php

class View {

    protected $_sTemplate = '';

    protected $_aVariables = array();

    protected $_sTemplateExtension = 'phtml';

    protected $_sTemplateDirectory = '../tpl/';

    public function setTemplate( $sTemplate ) {
        $this->_sTemplate = $sTemplate;

        return $this;
    }

    public function assignVariable( $sVariableName, $xVariableContent ) {
        $this->_aVariables[ $sVariableName ] = $xVariableContent;

        return $this;
    }

    public function render() {
        $data = (object) $this->_aVariables;
        ob_start();
        $sFilepath = $this->_sTemplateDirectory . $this->_sTemplate . '.' . $this->_sTemplateExtension;
        include $sFilepath;
        $sOutput = ob_get_contents();
        ob_end_clean();

        return $sOutput;
    }




} 