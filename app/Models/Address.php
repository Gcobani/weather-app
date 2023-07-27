<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string line_1
 * @property string line_2
 * @property string line_3
 * @property string postal_code
 * @property string city
 * @property string country
 */
class Address extends Model
{
    use HasFactory;
    /**
     * @var string []
     */
    protected $fillable = [
        'line_1',
        'line_2',
        'line_3',
        'postal_code',
        'city',
        'country',
    ];
}
