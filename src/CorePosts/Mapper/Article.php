<?php

namespace CorePosts\Mapper;

class Article extends AbstractPost
{
    /**
     * @param \CorePosts\Entity\Article[] $articles
     * @return \CorePosts\Entity\Article[]
     */
    public function fetchAuthors($articles)
    {
        $authorIds = array();
        foreach ($articles as $article) {
            if ($article->getAuthorId()) {
                $authorIds[] = $article->getAuthorId();
            }
        }

        if (count($authorIds) > 0) {
            $l = $this->getAuthorMapper()
                      ->fetchAll(array('person_id' => array_unique($authorIds)))
                      ->asArray();

            foreach ($articles as $article) {
                if (
                    $article->getAuthorId() &&
                    array_key_exists($article->getAuthorId(), $l)
                ) {
                    $article->setAuthor($l[$article->getAuthorId()]);
                }
            }
        }

        return $articles;
    }

    /**
     * @return \CorePosts\Mapper\Author
     */
    public function getAuthorMapper()
    {
        return $this->srv('\CorePosts\Mapper\Author');
    }
}
