<?php

namespace App\Components\Partners;

use Illuminate\Support\Str;
use App\Components\Core\Response;

class vnpay extends Partner
{
    protected function getBaseUri()
    {
        return $this->getConfigData('domain') . '/';

    }

    public function pay($data)
    {
        $uri = $this->genUri($data);

        $url = 'https://pay.1vnpay.org/api/v1/fundtransfer' . $uri;

        //return $this->getView($url, 'GET');
        return $url;
    }

    public function balance($data) {
        $uri = $this->genUri($data);

        $url = 'https://pay.1vnpay.org/api/v1/getMerchantBalance' . $uri;
        return $url;
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

    public function genUri($data)
    {
        $uri = "?";
        $index = 0;

        foreach($data as $key => $item) {

            if($index == 0) {

                $index++;
                $uri .= $key . '='.$item;
            } else {
                $uri .= '&' . $key . '='.$item;
            }
        };

        return $uri;
    }
}
