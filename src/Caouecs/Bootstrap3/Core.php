<?php

namespace Caouecs\Bootstrap3;

class Core
{
    /**
     * Display.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->show();
    }
}
