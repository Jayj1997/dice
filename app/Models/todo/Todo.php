<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\todo\TodoTabs;
use App\Models\todo\TodoItems;

class Todo extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tabs() {
        return $this->hasMany(TodoTabs::class);
    }

    public function items() {
        return $this->hasMany(TodoItems::class);
    }
}
