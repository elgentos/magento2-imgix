<?php

namespace Elgentos\Imgix\Model;

use Imgix\UrlBuilder;
use Magento\Store\Model\StoreManagerInterface;

class Image
{
    protected Config $config;

    protected StoreManagerInterface $storeManager;

    public function __construct(
        Config $config,
        StoreManagerInterface $storeManager
    ) {
        $this->config = $config;
        $this->storeManager = $storeManager;
    }

    public function getCustomUrl(string $imageUrl, int $width, int $height): string
    {
        return $this->getServiceUrl(
            $imageUrl,
            $this->generateImageUrlParams($width, $height)
        );
    }

    public function getServiceUrl(string $currentUrl, string $params): string
    {
        if(! $this->isServiceEnabled()) {
            return $currentUrl;
        }

        $serviceUrl = $this->config->getConfigValue(Config::XPATH_FIELD_SERVICE_URL);
        if(empty($serviceUrl)) {
            return $currentUrl;
        }

        return str_replace($this->storeManager->getStore()->getBaseUrl(),
            $serviceUrl, $currentUrl) . '?' . $params;
    }

    public function isServiceEnabled(): bool {
        return $this->config->isEnabled();
    }

    public function getSignedUrl($url, $params = [])
    {
        $host = parse_url($this->config->getConfigValue(Config::XPATH_FIELD_SERVICE_URL), PHP_URL_HOST);
        if (!$host) {
            return false;
        }

        $builder = new UrlBuilder($host);
        $builder->setSignKey($this->config->getConfigValue(Config::XPATH_FIELD_SIGN_KEY));
        return $builder->createURL($url, $params);
    }

    private function generateImageUrlParams(int $width, int $height): string
    {
        $params = [
            'w' => $width,
            'h' => $height,
            'auto' => 'compress',
            'trim' => $this->config->getConfigValue(Config::XPATH_FIELD_TRIM) ?: null,
            'fit' => $this->config->getConfigValue(Config::XPATH_FIELD_FIT) ?: null
        ];

        return http_build_query($params);
    }
}
