<?php

namespace CorePosts\CtrlController;

use CoreControl\Controller\AbstractController;
use CoreControl\Controller\SimpleFormTrait;

class ArticlesController extends AbstractController
{
    use SimpleFormTrait;

    protected $_route = 'ctrl-articles';
    protected $_title = 'Статьи';

    protected function _getMapper()
    {
        return $this->srv('\CorePosts\Mapper\Article');
    }

    protected function _createForm()
    {
        $form = $this->srv('\CorePosts\Form\Article');
        $form->bind($this->ent());

        return $form;
    }
}
