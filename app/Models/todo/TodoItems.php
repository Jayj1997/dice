<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\todo\Todo;
use App\Models\todo\TodoTabs;

class TodoItems extends Model
{
    protected $casts = [
        'important' => 'boolean',
        'sub' => 'boolean'
    ];

    public function todo() {
        return $this->belongsTo(Todo::class);
    }

    public function tabs() {
        // 如果不是必须存在tabs 会不会出错呢？
        return $this->belongsTo(TodoTabs::class);
    }
}
