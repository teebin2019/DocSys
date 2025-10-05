<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function documents()
    {
        return $this->hasMany(Document::class)->orderBy('created_at', 'desc');
    }
}
