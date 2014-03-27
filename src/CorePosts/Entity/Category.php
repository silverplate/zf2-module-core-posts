<?php

namespace CorePosts\Entity;

use CoreApplication\Entity\IdTrait;
use CoreApplication\Entity\IsPublishedTrait;
use CoreApplication\Entity\SortOrderTrait;

class Category
{
    use IdTrait;
    use IsPublishedTrait;
    use SortOrderTrait;

    /** @var int */
    private $_parentId;

    /** @var Category */
    private $_parent;

    /** @var string */
    private $_name;

    /** @var string */
    private $_uri;

    /** @var string */
    private $_title;

    /**
     * @param string $_name
     */
    public function setName($_name)
    {
        $this->_name = $_name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param Category $_parent
     */
    public function setParent($_parent)
    {
        $this->_parent = $_parent;
    }

    /**
     * @return Category
     */
    public function getParent()
    {
        return $this->_parent;
    }

    /**
     * @param int $_parentId
     */
    public function setParentId($_parentId)
    {
        $this->_parentId = $_parentId;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->_parentId;
    }

    /**
     * @param string $_title
     */
    public function setTitle($_title)
    {
        $this->_title = $_title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $_uri
     */
    public function setUri($_uri)
    {
        $this->_uri = $_uri;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }
}
