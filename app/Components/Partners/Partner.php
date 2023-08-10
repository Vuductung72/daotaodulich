<?php

namespace App\Components\Partners;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Components\Core\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Config\Repository;

abstract class Partner
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->getBaseUri(),
            'http_errors' => false
        ]);
    }

    public function makeRequest($path, $method = 'GET', $options = [])
    {
        $options = array_merge($this->getDefaultOptions(), $options);
        // $options['headers'] = $this->getHeaders($headers);
        $result = $this->client->request($method, $path, $options);
        $response = Response::create($result->getBody()->getContents(), $result->getStatusCode(), $result->getHeaders());
//        $this->log(array_merge([
//            'method' => $method,
//            'path' => $this->getBaseUri() . $path,
//        ], $options), [
//            'status' => $response->getStatusCode(),
//            'content' => $response->getContent()
//        ]);

        return $response;
    }

    public function getView($path, $method = 'GET', $options = [])
    {
        $options = array_merge($this->getDefaultOptions(), $options);
        // $options['headers'] = $this->getHeaders($headers);
        $result = $this->client->request($method, $path, $options);
        $response = $result->getBody()->getContents();

        
        return $response;
    }

    protected function log($request, $response)
    {
        config(['logging.channels.partner.path' => storage_path('logs/partners/' . Str::snake(class_basename(static::class)) . '.log')]);

        Log::channel('partner')->info(print_r([
            'request' => $request,
            'response' => $response
        ], true));
    }

    public function handleCallback(Request $request)
    {
        return response(['message' => 'Undefined callback with this partner'], Response::HTTP_OK);
    }

    /**
     * Retrieve configuration
     *
     * @param $field
     * @return Repository|mixed
     */
    public function getConfigData($field)
    {
        return config('partners.' . Str::snake(class_basename(static::class)) . '.' . $field);
    }

    protected function getDefaultOptions()
    {
        return [];
    }

    abstract protected function getBaseUri();

    // protected function getHeaders($headers)
    // {
    //     return $headers;
    // }
}
