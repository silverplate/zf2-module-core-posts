<?php

namespace CorePosts\Form;

use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Form\Element;
use Zend\Stdlib\Hydrator\ArraySerializable;
use CoreControl\Form\AbstractForm;
use CorePosts\Entity\AbstractPost as Model;

abstract class AbstractPost
extends AbstractForm
implements ServiceLocatorAwareInterface
{
    /** @var ServiceLocatorInterface */
    protected $_serviceLocator;

    public function getServiceLocator()
    {
        return $this->_serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $_serviceLocator)
    {
        $this->_serviceLocator = $_serviceLocator;
    }

    /**
     * @param ServiceManager $_sm
     */
    public function __construct(ServiceManager $_sm)
    {
        parent::__construct();

        $this->setHydrator(new ArraySerializable);
        $this->setServiceLocator($_sm);
        $this->addAuthors();
    }

    public function createElements()
    {
        $fieldset = new Fieldset('main');
        $fieldset->setLabel('Основное');
        $this->add($fieldset);

        $ele = new Element\Text('title');
        $ele->setLabel('Название');
        $ele->setOptions(array('is_required' => true));
        $fieldset->add($ele);

        $ele = new Element\Text('name');
        $ele->setLabel('Служебное название');
        $ele->setOptions(array('is_required' => true));
        $fieldset->add($ele);

        {
            $ele = new Element\Radio('status_id');
            $ele->setLabel('Статус статьи');
            $fieldset->add($ele);

            $options = array();
            foreach (Model::getStatuses() as $status) {
                $options[$status['id']] = $status['title'];
            }

            $ele->setValueOptions($options);
        }

        $ele = new Element\DateTime('publish_date');
        $ele->setFormat('Y-m-d H:i');
//        $ele->setOptions(array('description' => 'ГГГГ-ММ-ДД ЧЧ:ММ'));
        $ele->setLabel('Дата');
        $ele->setValue(date('Y-m-d H:i'));
        $fieldset->add($ele);

        $ele = new Element\Select('author_id');
        $ele->setLabel('Автор');
        $fieldset->add($ele);


        $fieldset = new Fieldset('content');
        $fieldset->setLabel('Текст');
        $this->add($fieldset);

        $ele = new Element\Textarea('intro');
        $ele->setLabel('Анонс');
        $ele->setAttribute('rows', 3);
        $fieldset->add($ele);

        $ele = new Element\Textarea('content');
        $ele->setLabel('Статья');
        $ele->setAttribute('rows', 17);
        $fieldset->add($ele);
    }

    public function addAuthors()
    {
        $mapper = $this->getServiceLocator()->get('\CorePosts\Mapper\Author');

        /** @var \CorePosts\Entity\Author[] $entities */
        $entities = $mapper->getList();

        $options = array();
        foreach ($entities as $entity) {
            $options[$entity->getId()] = $entity->getTitle();
        }

        $this->get('main')->get('author_id')->setValueOptions($options);
    }
}
