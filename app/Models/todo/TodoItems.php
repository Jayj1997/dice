<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\todo\Todo;

class TodoItems extends Model
{
    protected $casts = [
        'important' => 'boolean',
        'sub' => 'boolean'
    ];

    public function todo() {
        return $this->belongsTo(Todo::class);
    }

}
