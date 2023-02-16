<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Owner;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function condition(){
        return $this->hasOne(Condition::class, 'id', 'condition_id');
    }

    public function type(){
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    public function owner(){
        return $this->hasOne(Owner::class, 'id', 'owner_id');
    }
}
