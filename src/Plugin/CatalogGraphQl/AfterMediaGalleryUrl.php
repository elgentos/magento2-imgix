<?php

declare(strict_types=1);

namespace Elgentos\Imgix\Plugin\CatalogGraphQl;

use Elgentos\Imgix\Helper\ViewConfigHelper;
use Elgentos\Imgix\Model\Config;
use Elgentos\Imgix\Model\Image;
use Magento\CatalogGraphQl\Model\Resolver\Product\MediaGallery\Url;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class AfterMediaGalleryUrl
{
    private Image $image;

    private ViewConfigHelper $viewConfigHelper;

    private Config $config;

    public function __construct(
        Config $config,
        Image $image,
        ViewConfigHelper $viewConfigHelper
    ) {
        $this->image = $image;
        $this->viewConfigHelper = $viewConfigHelper;
        $this->config = $config;
    }

    /**
     * @param Url              $subject
     * @param string|array     $result
     * @param Field            $field
     * @param ContextInterface $context
     * @param ResolveInfo      $info
     * @param array|null       $value
     *
     * @return array|string
     */
    public function afterResolve(
        Url $subject,
        $result,
        Field $field,
        ContextInterface $context,
        ResolveInfo $info,
        array $value = null
    ) {
        if (empty($result)) {
            return $result;
        }

        if (!$this->config->isEnabled()) {
            return $result;
        }

        $dimensions = $this->viewConfigHelper
            ->getImageSize($value['image_type'] ?? 'product_page_image_small');

        return $this->image->getCustomUrl(
            $result,
            $dimensions['width'],
            $dimensions['height']
        );
    }
}
