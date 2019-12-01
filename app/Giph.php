<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Giph
 *
 * @property int $id
 * @property int $user_id
 * @property string $giphy_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
 * @property-read int|null $likes_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Giph newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Giph newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Giph query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Giph whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Giph whereGiphyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Giph whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Giph whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Giph whereUserId($value)
 * @mixin \Eloquent
 */
class Giph extends Model
{
    protected $withCount = ['likes'];

    public $fillable = [
        'user_id',
        'giphy_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function delete()
    {
        $this->likes()->delete();
        return parent::delete();
    }
}
