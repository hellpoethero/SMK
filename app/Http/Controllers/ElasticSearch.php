<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

use App\Http\Requests;

class ElasticSearch extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private static function client() {
        $hosts = ['http://104.155.223.176:9200'];
        $client = ClientBuilder::create()->setHosts($hosts)->build();
        return $client;
    }

    public static function params($type, $body) {
        return [
            'index' => 'smm',
            'type' => $type,
            'body' => $body
        ];
    }
    public static function search($type, $query) {
        if (array_key_exists('q',$query))
            SessionController::store('search',$query->q);
        $params = self::params($type,$query);
        $client = self::client();
        $response = $client->search($params)['hits']['hits'];
        return $response;
    }
}
