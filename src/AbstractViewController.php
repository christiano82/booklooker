<?php

namespace App\lf8;

abstract class AbstractViewController extends AbstractBaseController implements BaseController
{
    function build() 
    {
        switch($this->_command)
        {
            case 'view':
                $this->view();
                break;
            default:
                $this->default();
        }
    }
    abstract function default();
    abstract function view();
}
?>