<?php

namespace App\Services;

/**
 * Slug Class
 */
class Slug
{

    public $entity;

    public $attribute;

    /**
     *
     */
    public function __construct($entity, $attribute = 'slug')
    {
        $this->entity = $entity;
        $this->attribute = $attribute;
    }

    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function create($title)
    {
        if (empty($title)) {
            throw new \Exception('Title is empty');
        }

        // Normalize the title
        $slug = str_slug($title);

        $slugStoraged = $this->getRelated($slug);

        if ($slugStoraged == null) {
           return $slug;
        }

        $lastNum = intval(str_replace($slug . '-', '', $slugStoraged->{$this->attribute}));

        if (is_numeric($lastNum)) {
           return  $slug . '-' . ++$lastNum;
        }
    }

    public function getRelated($slug)
    {
        return call_user_func([$this->entity, 'select'], $this->attribute)
            ->where($this->attribute, 'like', $slug . '%')
            ->orderBy($this->attribute, 'desc')
            ->first();
    }
}