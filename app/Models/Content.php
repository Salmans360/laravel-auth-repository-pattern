<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unitTitle',
        'dealerEdit',
        'dealerID',
        'bActiveNum',
        'beginDate',
        'endDate',
        'hasDescription',
        'unitDescription',
        'hasImage',
        'imageFile',
        'imageLink',
        'imageAlt',
        'imageLinkTarget',
        'hasButton',
        'buttonLabel',
        'buttonLink',
        'buttonLinkTarget',
        'sortOrder',
        'isFullWidth',
    ];
}
