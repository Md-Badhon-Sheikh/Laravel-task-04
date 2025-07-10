<?php

namespace App\Models;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zilla extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['division_id', 'name_en', 'name_bn', 'priority', 'created_by'];

    public function division(){
        return $this->belongsTo(Division::class);
    }
}
