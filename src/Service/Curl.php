<?php

declare(strict_types=1);

namespace Elgentos\Imgproxy\Service;

class Curl extends \Magento\Framework\HTTP\Client\Curl
{
    /**
     * @param $uri
     * @param $params
     *
     * @return void
     */
    public function head($uri, array $params = [])
    {
        $this->setOptions([
            CURLOPT_URL => $uri,
            CURLOPT_CUSTOMREQUEST => 'HEAD',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_NOBODY => true
        ]);
        $this->makeRequest('HEAD', $uri, $params);
    }
}
