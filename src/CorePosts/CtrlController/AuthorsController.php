<?php

namespace CorePosts\CtrlController;

use CoreControl\Controller\AbstractController;
use CoreControl\Controller\SimpleFormTrait;
use CorePosts\Form\Author;

class AuthorsController extends AbstractController
{
    use SimpleFormTrait;

    protected $_route = 'ctrl-authors';
    protected $_title = 'Авторы';

    protected function _getMapper()
    {
        return $this->srv('\CorePosts\Mapper\Author');
    }

    protected function _createForm()
    {
        return new Author(null, $this->ent());
    }
}
