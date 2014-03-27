<?php

namespace CorePosts\Entity;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Stdlib\ArraySerializableInterface;
use Zend\Validator;
use CoreApplication\Entity\IdTrait;
use CorePeople\Entity\User;

abstract class AbstractPost
implements InputFilterAwareInterface, ArraySerializableInterface
{
    use IdTrait;

    const HIDDEN    = 0;
    const DRAFT     = 1;
    const PUBLISHED = 2;
    const ARCHIVE   = 3;
    const REJECTED  = 4;

    /** @var int */
    protected $_objectTypeId;

    /** @var int */
    protected $_objectId;

    /** @var array */
    protected static $_statuses;

    /** @var int */
    protected $_postCategoryId;

    /** @var Category */
    protected $_postCategory;

    /** @var int */
    protected $_statusId = self::HIDDEN;

    /** @var string */
    protected $_name;

    /** @var string */
    protected $_uri;

    /** @var string */
    protected $_title;

    /** @var string */
    protected $_intro;

    /** @var string */
    protected $_content;

    /** @var int */
    protected $_publishDate;

    /** @var int */
    protected $_creationTime;

    /** @var int */
    protected $_creatorId;

    /** @var User */
    protected $_creator;

    /** @var int */
    protected $_authorId;

    /** @var Author */
    protected $_author;

    /** @var InputFilter */
    protected $_inputFilter;

    /**
     * @param Author $_author
     */
    public function setAuthor(Author $_author)
    {
        $this->_author = $_author;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * @param int $_authorId
     */
    public function setAuthorId($_authorId)
    {
        $this->_authorId = $_authorId;
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->_authorId;
    }

    /**
     * @param string $_content
     */
    public function setContent($_content)
    {
        $this->_content = $_content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param int $_creationTime
     */
    public function setCreationTime($_creationTime)
    {
        $this->_creationTime = $_creationTime;
    }

    /**
     * @return int
     */
    public function getCreationTime()
    {
        return $this->_creationTime;
    }

    /**
     * @param User $_creator
     */
    public function setCreator(User $_creator)
    {
        $this->_creator = $_creator;
    }

    /**
     * @return User
     */
    public function getCreator()
    {
        return $this->_creator;
    }

    /**
     * @param int $_creatorId
     */
    public function setCreatorId($_creatorId)
    {
        $this->_creatorId = $_creatorId;
    }

    /**
     * @return int
     */
    public function getCreatorId()
    {
        return $this->_creatorId;
    }

    /**
     * @param string $_intro
     */
    public function setIntro($_intro)
    {
        $this->_intro = $_intro;
    }

    /**
     * @return string
     */
    public function getIntro()
    {
        return $this->_intro;
    }

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
     * @param Category $_postCategory
     */
    public function setPostCategory(Category $_postCategory)
    {
        $this->_postCategory = $_postCategory;
    }

    /**
     * @param Category $_category
     */
    public function setCategory($_category)
    {
        $this->setPostCategory($_category);
    }

    /**
     * @return Category
     */
    public function getPostCategory()
    {
        return $this->_postCategory;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->getPostCategory();
    }

    /**
     * @param int $_postCategoryId
     */
    public function setPostCategoryId($_postCategoryId)
    {
        $this->_postCategoryId = $_postCategoryId;
    }

    /**
     * @param int $_categoryId
     */
    public function setCategoryId($_categoryId)
    {
        $this->setPostCategoryId($_categoryId);
    }

    /**
     * @return int
     */
    public function getPostCategoryId()
    {
        return $this->_postCategoryId;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->getPostCategoryId();
    }

    /**
     * @param int $_publishDate
     */
    public function setPublishDate($_publishDate)
    {
        $this->_publishDate = $_publishDate;
    }

    /**
     * @return int
     */
    public function getPublishDate()
    {
        return $this->_publishDate;
    }

    /**
     * @param int $_statusId
     */
    public function setStatusId($_statusId)
    {
        $this->_statusId = $_statusId;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->_statusId;
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

    /**
     * @return array[]
     */
    public static function getStatuses()
    {
        if (!isset(static::$_statuses)) {
            static::$_statuses = array(
                static::HIDDEN    => array('title' => 'скрыта'),
                static::DRAFT     => array('title' => 'черновик'),
                static::PUBLISHED => array('title' => 'опубликована'),
                static::ARCHIVE   => array('title' => 'в архиве'),
                static::REJECTED  => array('title' => 'забракована')
            );

            foreach (array_keys(static::$_statuses) as $id) {
                static::$_statuses[$id]['id'] = $id;
            }
        }

        return static::$_statuses;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->getStatusId() == static::PUBLISHED;
    }

    /**
     * @param int $_objectId
     */
    public function setObjectId($_objectId)
    {
        $this->_objectId = $_objectId;
    }

    /**
     * @return int
     */
    public function getObjectId()
    {
        return $this->_objectId;
    }

    /**
     * @param int $_objectTypeId
     */
    public function setObjectTypeId($_objectTypeId)
    {
        $this->_objectTypeId = $_objectTypeId;
    }

    /**
     * @return int
     */
    public function getObjectTypeId()
    {
        return $this->_objectTypeId;
    }

    /**
     * @param int $_objectTypeId
     */
    public function __construct($_objectTypeId)
    {
        $this->setObjectTypeId($_objectTypeId);
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $_inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $_inputFilter)
    {
        $this->_inputFilter = $_inputFilter;
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if (null == $this->_inputFilter) {
            $main = new InputFilter();

            $input = new Input('title');
            $input->getValidatorChain()->attach(new Validator\NotEmpty());
            $main->add($input);

            $input = new Input('name');
            $input->getValidatorChain()->attach(new Validator\NotEmpty());
            $main->add($input);

            $filter = new InputFilter();
            $filter->add($main, 'main');
            $this->setInputFilter($filter);
        }

        return $this->_inputFilter;
    }

    /**
     * Exchange internal values from provided array
     *
     * @param  array $_data
     * @return void
     */
    public function exchangeArray(array $_data)
    {
        if (!empty($_data['main'])) {
            $section = $_data['main'];

            if (array_key_exists('title', $section)) {
                $this->setTitle($section['title']);
            }

            if (array_key_exists('name', $section)) {
                $this->setName($section['name']);
            }

            if (array_key_exists('publish_date', $section)) {
                $this->setPublishDate(
                    \Ext\Date::getDate($section['publish_date'])
                );
            }

            if (array_key_exists('status_id', $section)) {
                $this->setStatusId($section['status_id']);
            }

            if (array_key_exists('author_id', $section)) {
                $this->setAuthorId($section['author_id']);
            }
        }

        if (!empty($_data['content'])) {
            $section = $_data['content'];

            if (array_key_exists('intro', $section)) {
                $this->setIntro($section['intro']);
            }

            if (array_key_exists('content', $section)) {
                $this->setContent($section['content']);
            }
        }
    }

    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        $data = array(
            'main' => array(
                'title' => $this->getTitle(),
                'name' => $this->getName(),
                'author_id' => $this->getAuthorId(),
                'status_id' => $this->getStatusId(),
            ),
            'content' => array(
                'intro' => $this->getIntro(),
                'content' => $this->getContent(),
            )
        );

        if ($this->getPublishDate()) {
            $data['main']['publish_date'] = date(
                'Y-m-d H:i',
                $this->getPublishDate()
            );
        }

        return $data;
    }


    /**
     * @todo Do refactoring
    */

//    public static function sortByPublishDateDesc(
//        AbstractPost $_a,
//        AbstractPost $_b
//    )
//    {
//        $a = $_a->getPublishDate();
//        $b = $_b->getPublishDate();
//
//        if ($a == $b)     return 0;
//        else if ($a > $b) return -1;
//        else              return 1;
//    }
//
//    public static function sort(AbstractPost $_a, AbstractPost $_b)
//    {
//        return self::sortByPublishDateDesc($_a, $_b);
//    }
//
//    public function getDate()
//    {
//        return Date::formatExpanded($this->getPublishDate());
//    }
//
//    /**
//     * @param $_text string
//     * @return string
//     */
//    public function formatText($_text)
//    {
//        $text = trim($_text);
//
//        if ($text) {
//            // Markdown
//            $text = Markdown::defaultTransform($text);
//        }
//
//        return $text;
//    }
//
//    /**
//     * @return string
//     */
//    public function getFormattedContent()
//    {
//        return $this->formatText($this->getContent());
//    }
//
//    /**
//     * @return string
//     */
//    public function getFormattedIntro()
//    {
//        return $this->formatText($this->getIntro());
//    }
}
