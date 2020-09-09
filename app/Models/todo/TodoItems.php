<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\todo\Todo;

class TodoItems extends Model
{
    protected $casts = [
        'important' => 'integer',
        'sub' => 'boolean',
        'finish_at' => 'datetime'
    ];

    protected $fillable = [
        'todo_id', 'name', 'order', 'sub', 'important', 'finish_at'
    ];

    public function todo() {
        return $this->belongsTo(Todo::class);
    }

}
