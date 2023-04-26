<?php

namespace Elgentos\Imgix\Model;

class Image
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        Config $config,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->config = $config;
        $this->storeManager = $storeManager;
    }

    public function getCustomUrl(string $imageUrl, int $width, int $height): string
    {
        return $this->getServiceUrl($imageUrl, 'w=' . $dimensions['width'] . '&h=' . $dimensions['height'] . '&auto=compress&auto=format');
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

        $builder = new \Imgix\UrlBuilder($host);
        $builder->setSignKey($this->config->getConfigValue(Config::XPATH_FIELD_SIGN_KEY));
        return $builder->createURL($url, $params);
    }
}
