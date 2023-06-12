<?php

declare(strict_types=1);

namespace Elgentos\Imgix\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private const XPATH_FIELD_ENABLED = 'elgentos/imgix/enabled',
        XPATH_FIELD_SERVICE_URL = 'elgentos/imgix/host',
        XPATH_FIELD_SIGN_KEY = 'elgentos/imgix/secure_sign_key',
        XPATH_FIELD_TRIM = 'elgentos/imgix/trim',
        XPATH_FIELD_FIT = 'elgentos/imgix/fit';

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

    public function getImgixHost(?int $storeId = null): ?string
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
