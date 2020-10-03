<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\todo\Todo;

/**
 * App\Models\todo\TodoItems
 *
 * @property int $id
 * @property int $todo_id
 * @property string $name
 * @property int $order
 * @property bool $sub
 * @property int $important
 * @property \Illuminate\Support\Carbon|null $finish_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $schedule
 * @property string|null $common
 * @property-read Todo $todo
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereCommon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereFinishAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereImportant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereSub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereTodoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItems whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TodoItems extends Model
{
    protected $casts = [
        'important' => 'integer',
        'sub' => 'integer',
        'finish_at' => 'datetime'
    ];

    protected $fillable = [
        'todo_id', 'name', 'order', 'sub', 'important', 'finish_at'
    ];

    public function todo() {
        return $this->belongsTo(Todo::class);
    }

}
