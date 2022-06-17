<?php

namespace App\Libraries;

use App\Models\ApiusersModel;
use CodeIgniter\HTTP\Response;

class DhonRequest
{
    /**
     * Set api url.
     * 
     * @var mixed
     */
    protected $api_url = [
        'development'   => 'http://localhost/ci4_api2/public/',
        'testing'       => 'http://dev.dhonstudio.com/ci4/api2/',
    ];

    /**
     * Set basic auth.
     * 
     * @var string[]
     */
    protected $auth = ['admin', 'admin'];

    /**
     * CURL request.
     */
    protected $client;

    public function __construct()
    {
        $this->client       = \Config\Services::curlrequest();
    }

    /**
     * Request GET to URL Endpoint.
     * 
     * @param string $endpoint
     * 
     * @return void
     */
    public function get(string $endpoint)
    {
        return json_decode(json_decode($this->client->get($this->api_url[ENVIRONMENT] . $endpoint, [
            'auth' => $this->auth,
        ])->getJSON()), TRUE);
    }

    /**
     * Request POST to URL Endpoint.
     * 
     * @param string $endpoint
     * @param array $params
     * 
     * @return void
     */
    public function post(string $endpoint, array $params)
    {
        return json_decode(json_decode($this->client->post($this->api_url[ENVIRONMENT] . $endpoint, [
            'auth' => $this->auth,
            'form_params' => $params,
        ])->getJSON()), TRUE);
    }

    /**
     * Request CURL to an URL.
     * 
     * @param string $url
     * 
     * @return void
     */
    public function curl(string $url)
    {
        return json_decode($this->client->get($url)->getJSON());
    }
}
