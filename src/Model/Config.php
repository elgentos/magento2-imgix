<?php

declare(strict_types=1);

namespace Elgentos\Imgproxy\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private const IMGPROXY_GENERAL_ENABLED = 'imgproxy/general/enabled',
        IMGPROXY_GENERAL_HOST              = 'imgproxy/general/host',
        IMGPROXY_GENERAL_SECURE_SIGN_KEY   = 'imgproxy/general/secure_sign_key',
        IMGPROXY_GENERAL_SECURE_SIGN_SALT  = 'imgproxy/general/secure_sign_salt',
        IMGPROXY_PARAMS_ENLARGE            = 'imgproxy/params/enlarge',
        IMGPROXY_PARAMS_RESIZING_TYPE      = 'imgproxy/params/resizing_type',
        IMGPROXY_DEV_ENABLED               = 'imgproxy/dev/enabled',
        IMGPROXY_DEV_PRODUCTION_MEDIA_URL  = 'imgproxy/dev/production_media_url';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::IMGPROXY_GENERAL_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getImgproxyHost(?int $storeId = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::IMGPROXY_GENERAL_HOST,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: null;
    }

    public function getDevMode(?int $storeId = null): bool
    {
        return (bool) $this->scopeConfig->getValue(
            self::IMGPROXY_DEV_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getProductionMediaUrl(?int $storeId = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::IMGPROXY_DEV_PRODUCTION_MEDIA_URL,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: null;
    }

    public function getSignKey(?int $storeId = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::IMGPROXY_GENERAL_SECURE_SIGN_KEY,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: null;
    }

    public function getSignSalt(?int $storeId = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::IMGPROXY_GENERAL_SECURE_SIGN_SALT,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: null;
    }

    public function getEnlargeMode(?int $storeId = null): bool
    {
        return (bool) $this->scopeConfig->getValue(
            self::IMGPROXY_PARAMS_ENLARGE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getResizingType(?int $storeId = null): string
    {
        return $this->scopeConfig->getValue(
            self::IMGPROXY_PARAMS_RESIZING_TYPE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
