<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    private $id;

    private $name;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
    * sujet relations
    */
    public function topics()
    {
        return $this->hasMany('App\Topic');
    }
}
