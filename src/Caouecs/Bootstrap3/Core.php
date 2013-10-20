<?php namespace Caouecs\Bootstrap3;

class Core {

    /**
     * Display
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        return $this->show();
    }

}