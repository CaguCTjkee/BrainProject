<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/18/17
 * Time: 15:45
 */

namespace Core\System;

class Meta
{
    static $_instance;
    static $metaTitle, $metaDescription, $metaKeywords, $metaAuthor;
    const META_TITLE_NAME = 'title';
    const META_DESCRIPTION_NAME = 'description';
    const META_KEYWORDS_NAME = 'keywords';
    const META_AUTHOR_NAME = 'author';

    static function getInstance()
    {
        if( self::$_instance === null )
            self::$_instance = new self();

        return self::$_instance;
    }

    public function setMetaArray($meta = [])
    {
        $meta = [
            'author' => !empty($meta['author']) ? $meta['author'] : Setup::$AUTHOR,
            'description' => !empty($meta['description']) ? $meta['description'] : Setup::$_config['description'],
            'keywords' => !empty($meta['keywords']) ? $meta['keywords'] : Setup::$_config['keywords'],
            'title' => !empty($meta['title']) ? $meta['title'] : Setup::$_config['title'],
        ];

        if( $meta )
        {
            $this->setMetaAuthor($meta['author']);

            $this->setMetaDescription($meta['description']);

            $this->setMetaKeywords($meta['keywords']);

            $this->setMetaTitle($meta['title']);
        }
    }

    public function getMetaHtml()
    {
        $meta_template = '<meta name="%s" content="%s">' . EL;
        $title_template = '<title>%s</title>' . EL;
        $return = '';

        $return .= sprintf($meta_template, self::META_AUTHOR_NAME, $this->getMetaAuthor());
        $return .= sprintf($meta_template, self::META_KEYWORDS_NAME, $this->getMetaKeywords());
        $return .= sprintf($meta_template, self::META_DESCRIPTION_NAME, $this->getMetaDescription());
        $return .= sprintf($title_template, $this->getMetaTitle());

        return $return;
    }

    /**
     * @return mixed
     */
    public function getMetaAuthor()
    {
        return self::$metaAuthor;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return self::$metaDescription;
    }

    /**
     * @return mixed
     */
    public function getMetaKeywords()
    {
        return self::$metaKeywords;
    }

    /**
     * @return mixed
     */
    public function getMetaTitle()
    {
        return self::$metaTitle;
    }

    /**
     * @param mixed $metaAuthor
     */
    public function setMetaAuthor($metaAuthor)
    {
        self::$metaAuthor = $metaAuthor;
    }

    /**
     * @param mixed $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        self::$metaDescription = $metaDescription;
    }

    /**
     * @param mixed $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        self::$metaKeywords = $metaKeywords;
    }

    /**
     * @param mixed $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        self::$metaTitle = $metaTitle;
    }
}