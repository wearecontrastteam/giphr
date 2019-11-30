<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Like
 *
 * @property int $id
 * @property int $user_id
 * @property int $giph_id
 * @property string $giphy_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Giph $giph
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereGiphyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereGiphId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereUserId($value)
 * @mixin \Eloquent
 */
class Like extends Model
{
    public $fillable = [
        'user_id',
        'giph_id',
        'giphy_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function giph()
    {
        return $this->belongsTo(Giph::class);
    }
}
