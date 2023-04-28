<?php

namespace Elgentos\Imgix\Plugin\CatalogGraphQl;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class AfterMediaGalleryUrl
{
    /**
     * @var \Elgentos\Imgix\Model\Image
     */
    private $image;

    /**
     * @var \Elgentos\Imgix\Helper\ViewConfigHelper
     */
    private $viewConfigHelper;

    public function __construct(
        \Elgentos\Imgix\Model\Image $image,
        \Elgentos\Imgix\Helper\ViewConfigHelper $viewConfigHelper
    ) {
        $this->image = $image;
        $this->viewConfigHelper = $viewConfigHelper;
    }

    public function afterResolve(
        $subject,
        $result,
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (empty($result)) {
            return $result;
        }

        if (! $this->image->isServiceEnabled()) {
            return $result;
        }

        $imageId = isset($value['image_type']) ? $value['image_type'] : 'product_page_image_small';

        $dimensions = $this->viewConfigHelper->getImageSize($imageId);
        $imgixUrl = $this->image->getCustomUrl($result, $dimensions['width'], $dimensions['height']);

        return $imgixUrl;
    }
}
