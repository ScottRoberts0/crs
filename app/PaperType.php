<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaperType extends Model
{
    use SoftDeletes;
    public function copysettings()
    {
        return $this->hasMany(CopySetting::class);
    }
}
