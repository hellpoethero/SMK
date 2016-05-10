<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $data['source'] = ElasticSearch::search('source', ['query' => [
            'match_all' => []
        ]]);
        return view('page.index')->with('data',$data);
    }
}
