<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TodoItem
 *
 * @package App
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItem whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoItem whereUpdatedAt($value)
 */
class TodoItem extends Model
{
    protected $fillable = ['title', 'body'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
