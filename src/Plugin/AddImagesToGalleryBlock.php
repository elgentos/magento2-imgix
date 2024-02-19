<?php

declare(strict_types=1);

namespace Elgentos\Imgproxy\Plugin;

use Elgentos\Imgproxy\Model\Config;
use Elgentos\Imgproxy\Model\Image;
use Exception;
use Magento\Catalog\Block\Product\View\Gallery;
use Elgentos\Imgproxy\Helper\ViewConfigHelper;
use Magento\Framework\Data\Collection;

class AddImagesToGalleryBlock
{
    protected Image $image;

    protected ViewConfigHelper $viewConfigHelper;

    private Config $config;

    public function __construct(
        Image $image,
        ViewConfigHelper $viewConfigHelper,
        Config $config
    ) {
        $this->image                 = $image;
        $this->viewConfigHelper      = $viewConfigHelper;
        $this->config                = $config;
    }

    public function afterGetGalleryImages(
        Gallery $subject,
        Collection $images
    ): Collection {
        if (!$this->config->isEnabled()) {
            return $images;
        }

        try {
            $imageIds = [
                'small'  => 'product_page_image_small',
                'medium' => 'product_page_image_medium',
                'large'  => 'product_page_image_large'
            ];

            foreach ($images as $image) {
                $existingImageId = $image->getImageId();

                if ($existingImageId) {
                    $dimensions = $this->viewConfigHelper->getImageSize($existingImageId);

                    $image->setUrl(
                        $this->image->getCustomUrl(
                            $image->getUrl(),
                            $dimensions['width'],
                            $dimensions['height']
                        )
                    );

                    continue;
                }

                foreach ($imageIds as $size => $imageId) {
                    $dimensions = $this->viewConfigHelper->getImageSize($imageId);
                    $imgproxyUrl   = $this->image->getCustomUrl(
                        $image->getUrl(),
                        $dimensions['width'],
                        $dimensions['height']
                    );

                    switch ($size) {
                        case 'small':
                            $image->setSmallImageUrl($imgproxyUrl);
                            break;

                        case 'medium':
                            $image->setMediumImageUrl($imgproxyUrl);
                            break;

                        case 'large':
                            $image->setLargeImageUrl($imgproxyUrl);
                            break;

                        default:
                            $image->setUrl($imgproxyUrl);
                            break;
                    }
                }
            }

            return $images;
        } catch (Exception $e) {
            return $images;
        }
    }
}
