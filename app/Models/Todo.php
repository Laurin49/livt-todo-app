<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'prior', 'erledigt', 'user_id', 'category_id'];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function category() {
      return $this->belongsTo(Category::class);
    }

    // protected function erledigt(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn (bool $value) => isset($value) ? 1 : 0,
    //     );
    // }
}
