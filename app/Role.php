<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    private $id;

    private $name;

    private $color;

    protected $fillable = [
        'name', 'color'
    ];

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
    *  users relations
    */
    public function users()
    {
        return $this->BelongsToMany('App\User');
    }

    /**
     * Get the value of color
     */ 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }
}
