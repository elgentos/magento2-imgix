<?php

namespace Elgentos\Imgix\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Config\View;

class ViewConfigHelper extends AbstractHelper
{
    protected $viewConfig;

    public function __construct(
        Context $context,
        View $viewConfig
    ) {
        parent::__construct($context);
        $this->viewConfig = $viewConfig;
    }

    public function getImageSize(string $imageId): array
    {
        $imageConfig = $this->viewConfig->getMediaAttributes('Magento_Catalog', 'images', $imageId);
        return [
            'width' => $imageConfig['width'],
            'height' => $imageConfig['height'],
        ];
    }
}
