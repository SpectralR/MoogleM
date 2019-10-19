<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    private $id;

    private $title;

    private $created_at;

    private $locked;

    protected $fillable = [
        'title', 'locked', 'user_id'
    ];
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of locked
     */ 
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set the value of locked
     *
     * @return  self
     */ 
    public function setLocked(bool $locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
    * user relations
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * category relations
    */
    public function categorie()
    {
        return $this->belongsTo('App\Category');
    }

    /**
    * message relations
    */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
