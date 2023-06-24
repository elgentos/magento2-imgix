<?php

declare(strict_types=1);

namespace Elgentos\Imgproxy\Model;

use Imgproxy\UrlBuilder;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

// phpcs:disable Magento2.Functions.DiscouragedFunction.Discouraged

class Image
{
    protected Config $config;

    protected StoreManagerInterface $storeManager;

    public function __construct(
        Config $config,
        StoreManagerInterface $storeManager
    ) {
        $this->config       = $config;
        $this->storeManager = $storeManager;
    }

    public function getCustomUrl(
        string $imageUrl,
        int $width,
        int $height
    ): string {
        return $this->getServiceUrl(
            $imageUrl,
            $this->generateImageUrlParams($width, $height)
        );
    }

    public function getServiceUrl(
        string $currentUrl,
        string $params
    ): string {
        if (!$this->config->isEnabled()) {
            return $currentUrl;
        }

        $serviceUrl = $this->config->getImgproxyHost();

        if (empty($serviceUrl)) {
            return $currentUrl;
        }

        /** @var Store $store */
        $store = $this->storeManager->getStore();

        return str_replace(
            $store->getBaseUrl(),
            $serviceUrl,
            $currentUrl
        ) . '?' . $params;
    }

    public function getSignedUrl(string $url, array $params = []): ?string
    {
        $host = parse_url(
            $this->config->getImgproxyHost(),
            PHP_URL_HOST
        );

        if (!$host) {
            return null;
        }

        $builder = new UrlBuilder($host);
        $builder->setSignKey($this->config->getSignKey());

        return $builder->createURL($url, $params);
    }

    private function generateImageUrlParams(int $width, int $height): string
    {
        $params = [
            'w' => $width,
            'h' => $height,
            'auto' => 'compress',
            'trim' => $this->config->getTrimMode(),
            'fit' => $this->config->getFitMode()
        ];

        return http_build_query($params);
    }
}
