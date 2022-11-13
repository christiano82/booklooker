<?php
namespace App\lf8;
use App\lf8\AbstractBaseController;

abstract class AbstractCrudController extends AbstractBaseController implements BaseController
{
    public function build() 
    {
        switch($this->_command) {
            case 'create':
                $this->create();
                break;
            case 'read':
                $this->read();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->default();
                break;
        }
    }
    abstract function create();
    abstract function read();
    abstract function update();
    abstract function delete();
    abstract function default();
}