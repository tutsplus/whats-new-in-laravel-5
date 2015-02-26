<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;

class PostsController extends Controller {

    public function __construct(Request $req)
    {
        $this->request = $req;
    }

    public function index(Cache $cache)
    {
        $posts = $cache->get('posts', []);
        return response()->view('post', compact('posts'));
    }

    public function store(Cache $cache)
    {
        $input = $this->request->only('title', 'body');
        $v     = Validator::make($input, [
            'title' => 'required|min:3',
            'body' => 'required',
        ]);

        if ($v->fails()) {
            return redirect('/')->withErrors($v->errors());
        }

        $posts   = $cache->get('posts', []);
        $posts[] = $input;
        $cache->put('posts', $posts, 5);

        return $this->index($cache);
    }

}
