<?php

namespace CorePosts\Mapper;

use CoreApplication\Mapper\AbstractMapper;
use CoreApplication\Mapper\ObjectTypeFeatureTrait;

abstract class AbstractPost extends AbstractMapper
{
    use ObjectTypeFeatureTrait {
        __construct as traitConstructor;
    }

    public $table = 'post';

    public function __construct($_objectTypeId = null)
    {
        $this->traitConstructor($_objectTypeId);
    }
}
