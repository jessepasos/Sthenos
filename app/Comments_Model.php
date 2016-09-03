<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments_Model extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'user_id', 'image_id', 'flag'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at'];
}
