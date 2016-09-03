<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Images_Model extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'resource', 'user_id', 'flag'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at'];

    public static function getPendingImages()
    {
        return DB::table('images')
            ->join('users', 'users.id', '=', 'images.user_id')
            ->where('images.flag', '2')
            ->select('images.*', 'users.name as username')
            ->get();
    }
}
