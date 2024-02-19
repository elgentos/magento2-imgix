<?php

declare(strict_types=1);

namespace Elgentos\Imgproxy\Block;

use Elgentos\Imgproxy\Model\Config;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class Preconnect extends Template
{
    protected Config $config;

    protected StoreManagerInterface $storeManager;

    public function __construct(
        Template\Context $context,
        Config $config,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->config = $config;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getHost(): string
    {
        return $this->config->getImgproxyHost() ?? '';
    }
}
