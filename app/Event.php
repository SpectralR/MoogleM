<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    private $id;

    private $name;

    private $description;

    private $date;

    public $timestamps = false;

    protected $fillable = [
      'name', 'description', 'date'
    ];

    public function users(){
      return $this->belongsToMany('App\User')->withPivot('participate');
    }

    public function __toString()
    {
      return $this->name;
    }
    public function getId()
    {
      return $this->id;
    }

    public function getName()
    {
      return $this->name;
    }

    public function setName($name)
    {
      $this->name = $name;
    }

    /**
    * User relation 
    */
    public function user()
    {
      return $this->belongsToMany('App\User')->withPivot('participate');
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}
