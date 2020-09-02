<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\todo\Todo;
use App\Models\todo\TodoItems;

class TodoTabs extends Model
{
    public function todo() {
        return $this->belongsTo(Todo::class);
    }

    public function items() {
        return $this->hasMany(TodoItems::class);
    }
}
