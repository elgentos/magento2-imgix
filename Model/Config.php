<?php

namespace Elgentos\Imgix\Model;

use Magento\Store\Model\ScopeInterface;

class Config
{
    const XML_PATH = 'elgentos/imgix/';

    const XPATH_FIELD_ENABLED = 'enabled';
    const XPATH_FIELD_SERVICE_URL = 'host';
    const XPATH_FIELD_SMALL = 'small_options';
    const XPATH_FIELD_LARGE = 'default_options';
    const XPATH_FIELD_SIGN_KEY = 'secure_sign_key';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getConfigValue($field, $prefix = self::XML_PATH, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $prefix . $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function isEnabled(): bool {
        return (bool) $this->getConfigValue(self::XPATH_FIELD_ENABLED) ?? false;
    }
}
