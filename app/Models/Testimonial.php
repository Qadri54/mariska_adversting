<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';
    protected $primaryKey = 'testimonial_id';
    
    protected $fillable = [
        'name',
        'role',
        'content',
        'initial',
        'rating'
    ];
}