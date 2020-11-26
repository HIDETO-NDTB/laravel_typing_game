<?php

namespace App;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class Drill extends Model
{
    protected $fillable = ['title', 'category_id', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
