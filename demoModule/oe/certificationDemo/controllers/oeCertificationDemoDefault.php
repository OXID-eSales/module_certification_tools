<?php
/**
 * #PHPHEADER_OXID_LICENSE_INFORMATION#
 */


class oeCertificationDemoDefault
{
    public function getOne()
    {
        $a = 5;
        $b=4;
        return $a-$b;
    }

    public function getBySelection( $selector )
    {
        if ( 'a' == $selector ) {
            $this->callA();
        } elseif ( 'b' == $selector ) {
            $this->callB();
        } elseif ( 'c' == $selector ) {
            $this->callC();
        } else {
            $this->callDefault();
        }
    }

    private function callA()
    {
        return;
    }

    private function callB()
    {
        return;
    }

    private function callC()
    {
        return;
    }

    private function callDefault()
    {
        return;
    }
}
