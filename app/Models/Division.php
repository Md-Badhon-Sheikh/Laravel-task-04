<?php

namespace App\Models;
use App\Models\Zilla;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function zilla(){
        return $this->hasMany(Zilla::class);
    }
}
