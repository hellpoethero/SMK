<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\ElasticSearch;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        return view('home');
    }

    public function jsonData(Request $request) {
        $param['query']['filtered']['filter']['geo_distance']['distance'] = "1km";
        $param['query']['filtered']['filter']['geo_distance']['location'] = $request->location;
        $param['sort']['_geo_distance']['location'] = $request->location;
        $param['sort']['_geo_distance']['order'] = "asc";
        $param['sort']['_geo_distance']['unit'] = "m";

        return response()->json(ElasticSearch::search($request->type, $param));
    }

    public function search(Request $request) {
        $post['query']['match_phrase']['content'] = $request->q;
        $post['sort']['date']['order'] = 'desc';
        $source['query']['match_phrase']['name'] = $request->q;
        $source['sort']['likes']['order'] = 'desc';

        $data['query'] = $request->q;
        $data['post'] = ElasticSearch::search('post', $post);
        $data['source'] = ElasticSearch::search('source', $source);
        return view('search')->with('data', $data);
    }

    public function about() {
        return view('about');
    }
}
