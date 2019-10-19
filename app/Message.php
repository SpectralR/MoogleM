<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    private $id;

    private $message;

    private $creation_at;

    protected $fillable = [
        'message', 'topic_id'
    ];

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of creation_at
     */ 
    public function getCreation_at()
    {
        return $this->creation_at;
    }

    /**
     * Set the value of creation_at
     *
     * @return  self
     */ 
    public function setCreation_at($creation_at)
    {
        $this->creation_at = $creation_at;

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
    * sujet relations
    */
    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }
}
