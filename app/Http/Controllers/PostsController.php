<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Cache;
use Validator;

use Illuminate\Http\Request;

class PostsController extends Controller {

    public function __construct(Request $req)
    {
        $this->request = $req;
    }

    public function index()
    {
        $posts = Cache::get('posts', []);
        return response()->view('post', compact('posts'));
    }

    public function store()
    {
        $input = Input::only('title', 'body');
        $v     = Validator::make($input, [
            'title' => 'required|min:3',
            'body' => 'required',
        ]);

        if ($v->fails()) {
            return redirect('/')->withErrors($v->errors());
        }

        $posts   = Cache::get('posts', []);
        $posts[] = $input;
        Cache::put('posts', $posts, 5);

        return redirect('/');
    }

}
