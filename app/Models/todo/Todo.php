<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\todo\TodoItems;

class Todo extends Model
{

    protected $fillable = [
        'name', 'priority', 'label'
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }


    public function items() {
        return $this->hasMany(TodoItems::class);
    }
}
