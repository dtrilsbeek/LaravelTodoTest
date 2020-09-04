<?php

namespace App;

//use Barryvdh\LaravelIdeHelper\Eloquent;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
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
 * @method static Builder|TodoItem newModelQuery()
 * @method static Builder|TodoItem newQuery()
 * @method static Builder|TodoItem query()
 * @method static Builder|TodoItem whereBody($value)
 * @method static Builder|TodoItem whereCreatedAt($value)
 * @method static Builder|TodoItem whereId($value)
 * @method static Builder|TodoItem whereTitle($value)
 * @method static Builder|TodoItem whereUpdatedAt($value)
 */
class TodoItem extends Model
{
    protected $fillable = ['title', 'body'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
