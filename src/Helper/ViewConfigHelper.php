<?php

declare(strict_types=1);

namespace Elgentos\Imgix\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Config\View;

class ViewConfigHelper extends AbstractHelper
{
    private const DEFAULT_IMAGE_WIDTH = 700,
        DEFAULT_IMAGE_HEIGHT = 700;

    protected View $viewConfig;

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
            'width' => $imageConfig['width'] ?? self::DEFAULT_IMAGE_WIDTH,
            'height' => $imageConfig['height'] ?? self::DEFAULT_IMAGE_HEIGHT,
        ];
    }
}
