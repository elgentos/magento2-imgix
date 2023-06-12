<?php

namespace Elgentos\Imgix\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    const XML_PATH = 'elgentos/imgix/';

    const XPATH_FIELD_ENABLED = 'enabled';
    const XPATH_FIELD_SERVICE_URL = 'host';
    const XPATH_FIELD_SIGN_KEY = 'secure_sign_key';
    const XPATH_FIELD_TRIM = 'trim';
    const XPATH_FIELD_FIT = 'fit';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getConfigValue($field, $prefix = self::XML_PATH, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $prefix . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isEnabled(): bool {
        return (bool) $this->getConfigValue(self::XPATH_FIELD_ENABLED) ?? false;
    }
}
