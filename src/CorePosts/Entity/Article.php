<?php

namespace CorePosts\Entity;

use Application\Entity\ObjectType;

class Article extends AbstractPost
{
    public function __construct()
    {
        parent::__construct(ObjectType::ARTICLE);
    }
}
