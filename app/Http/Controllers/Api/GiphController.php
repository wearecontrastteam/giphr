<?php

namespace App\Http\Controllers\Api;

use App\Giph;
use App\Http\Controllers\Controller;
use App\Http\Resources\Giph as GiphResource;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiphController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return GiphResource::collection(
            Giph::with(['user', 'likes.user'])
                ->latest()
                ->paginate(20)
        );
    }

    public function show(Giph $giph)
    {
        $giph->load([
            'user',
            'likes.user'
        ]);
        return new GiphResource($giph);
    }

    public function create(Request $request)
    {
        auth()->user()->giphs()->create([
            'giphy_id' => $request->get('giphy_id'),
        ]);

        return ['status' => 'ok'];
    }

    public function like(Giph $giph)
    {
        $user_id = auth()->id();
        if($giph->likes()->whereUserId($user_id)->exists()){
            $giph->likes()->whereUserId($user_id)->delete();
        } else {
            $giph->likes()->create([
                'user_id' => auth()->user()->id,
                'giphy_id' => $this->getRandomLikeGiphyId($giph)
            ]);
        }

        return new GiphResource($giph->fresh()->load('likes.user'));
    }

    private function getRandomLikeGiphyId(Giph $giph)
    {
        if($giph->giphy_id === 'cYJgsdeB6VThe'){
            return $giph->giphy_id;
        }

        return collect([
            'kigfYxdEa5s1ziA2h1', 'tIeCLkB8geYtW', '8xSnw21AM7OQo', 'awXuQy3EFjOLu', 'oBPOP48aQpIxq', 'FdEtkemRg6vo4',
            '10tbKyKsjdrOzC', 'SP11Gcowulfr2', '8SyzTfbhThVNS', 'cbb8zL5wbNnfq', 'cGEWR5jiq9AWc', 'xGDVFwXnboGY',
            '4cxhgC3nosoWk', '3o6Zt8qDiPE2d3kayI', 'l3JDwkm6TeNqTkoMM', 'XreQmk7ETCak0', 'GCvktC0KFy9l6', '9Ai5dIk8xvBm0',
            '3KVKgMOs8rXnomiVdD', 'FpKKILCKqNIgIE1GZf', 'oyZAfALXOHm6c6DHne', '1dagNhv8Oqu6l8U3ZK', 'b5WsjNpMc35za',
            // added by Andy
            '14cilFdQzr8hG0', '5fBH6zoy1szfjORd14s', 'i1jrd0R8wL7pe', 'w2I9CSZRqEhbi', '6WJroWFPN2LyE', '11ISwbgCxEzMyY', 'aLdiZJmmx4OVW', 'Bmk7yUVC4iM0g'
        ])->random(1)[0];
    }

    public function delete( Giph $giph )
    {
        if(auth()->id() === $giph->user_id){
            $giph->delete();
        }

        return ['deleted' => true];
    }
}
