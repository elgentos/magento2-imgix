<?php

declare(strict_types=1);

namespace Elgentos\Imgproxy\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private const XPATH_FIELD_ENABLED = 'elgentos/imgproxy/enabled',
        XPATH_FIELD_SERVICE_URL = 'elgentos/imgproxy/host',
        XPATH_FIELD_SIGN_KEY = 'elgentos/imgproxy/secure_sign_key',
        XPATH_FIELD_TRIM = 'elgentos/imgproxy/trim',
        XPATH_FIELD_FIT = 'elgentos/imgproxy/fit';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XPATH_FIELD_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getImgproxyHost(?int $storeId = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::XPATH_FIELD_SERVICE_URL,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: null;
    }

    public function getSignKey(?int $storeId = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::XPATH_FIELD_SIGN_KEY,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: null;
    }

    public function getTrimMode(?int $storeId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XPATH_FIELD_TRIM,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getFitMode(?int $storeId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XPATH_FIELD_FIT,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
