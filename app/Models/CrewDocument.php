<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'crew_id',
        'code',
        'doctype',
        'docname',
        'docnum',
        'dateissued',
        'dateexpire',
        'uploadedby',
        'docpath',
    ];
}
