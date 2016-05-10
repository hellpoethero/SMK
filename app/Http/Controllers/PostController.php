<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $param['query']['match_all'] = [];
        $param['sort']['date']['order'] = 'desc';
        $data['post'] = ElasticSearch::search('post', $param);
        return view('post.index')->with('data', $data);
    }
}
