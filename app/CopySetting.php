<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CopySetting extends Model
{
    use SoftDeletes;
    public function paper_type()
    {
        return $this->belongsTo(PaperType::class);
    }
}
