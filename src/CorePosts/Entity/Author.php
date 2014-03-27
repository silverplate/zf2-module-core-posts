<?php

namespace CorePosts\Entity;

use CorePeople\Entity\Person;
use Application\Entity\ObjectType;

class Author extends Person
{
    /**
     * @param int $_objectTypeId
     */
    public function __construct($_objectTypeId = null)
    {
        parent::__construct($_objectTypeId ?: ObjectType::AUTHOR);
    }
}
