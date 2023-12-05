<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mprima extends Model
{
    use HasFactory;
    protected $table = 'mprimas';
    protected $fillable = [
        'nom_mprima', 'img_mprima', 'cost_mprima', 'status',
    ];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        return asset('upload/mprimas/' . $this->image);
    }

}
