<?php

namespace App\Models\Traits;

trait Sluggable
{
    /**
     * Get title of the model.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title of the model.
     *
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get slug of the model.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug of the model.
     *
     * @param $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Find model by slug.
     *
     * @param \Doctrine\DBAL\Query\QueryBuilder $query
     * @param string                            $slug
     *
     * @return mixed
     */
    public function scopeNamed($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}