<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'workers';

    /**
     * @var array
     */
    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
