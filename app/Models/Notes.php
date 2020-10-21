<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = "notes";
    public $timestamps = true;

    protected $fillable = [
		'title','note'
	];
}
