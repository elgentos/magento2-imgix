<?php

namespace Elgentos\Imgix\Block;

use Elgentos\Imgix\Model\Config;
use Magento\Framework\View\Element\Template;

class Imgix extends Template
{

    protected $_template = 'Elgentos_Imgix::preconnect.phtml';

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        Template\Context $context,
        Config $config,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->config = $config;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getHost() {
        return $this->config->getConfigValue('elgentos/imgix/host', null, $this->storeManager->getStore()->getId());
    }

    /**
     * Only return if items are found
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (! $this->config->isEnabled()) {
            return '';
        }

        return parent::_toHtml();
    }
}
