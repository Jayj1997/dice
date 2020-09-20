<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\todo\TodoItems;

/**
 * App\Models\todo\Todo
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $priority
 * @property int $finish_rate
 * @property int $fail_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $label
 * @property-read \Illuminate\Database\Eloquent\Collection|TodoItems[] $items
 * @property-read int|null $items_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Todo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Todo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Todo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereFailRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereFinishRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereUserId($value)
 * @mixin \Eloquent
 */
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
