<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Service
{
    protected ?Client $clientGuzzle;

    function getClientGuzzle($getNewForce = false): Client
        {
            if (empty($this->clientGuzzle) || $getNewForce) {
                $this->clientGuzzle = new Client();
            }
            return $this->clientGuzzle;
        }

    public function getNewRequest(string $method, $url, array $heders = [], $body = null): Request
    {
        return new Request($method, $url);
    }
    public function getDataWithRequest(Request $request)
    {
        return $this->getClientGuzzle()
            ->sendAsync($request)
            ->wait();
    }
    public function getDataFormAPI($method, string $urlRequest):string
    {
        $res = $this->getDataWithRequest($this->getNewRequest($method, $urlRequest));
        return (string)$res->getbody();
    }
}
