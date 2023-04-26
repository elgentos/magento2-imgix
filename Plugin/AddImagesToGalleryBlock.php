<?php

namespace Elgentos\Imgix\Plugin;

use Magento\Catalog\Block\Product\View\Gallery;
use Magento\Framework\Data\CollectionFactory;
use Elgentos\Imgix\Helper\ViewConfigHelper;

class AddImagesToGalleryBlock
{
    /**
     * @var CollectionFactory
     */
    protected $dataCollectionFactory;

    /**
     * @var \Elgentos\Imgix\Model\Image
     */
    protected $image;

    /**
     * @var ViewConfigHelper
     */
    protected $viewConfigHelper;

    /**
     * AddImagesToGalleryBlock constructor.
     *
     * @param \Elgentos\Imgix\Model\Image $image
     * @param CollectionFactory $dataCollectionFactory
     * @param ViewConfigHelper $viewConfigHelper
     */
    public function __construct(
        \Elgentos\Imgix\Model\Image $image,
        CollectionFactory $dataCollectionFactory,
        ViewConfigHelper $viewConfigHelper
    ) {
        $this->dataCollectionFactory = $dataCollectionFactory;
        $this->image = $image;
        $this->viewConfigHelper = $viewConfigHelper;
    }

    public function afterGetGalleryImages(Gallery $subject, $images)
    {
        if (!$this->image->isServiceEnabled()) {
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
                    $imgixUrl = $this->image->getCustomUrl($image->getUrl(), $dimensions['width'], $dimensions['height']);
                    $image->setUrl($imgixUrl);
                } else {
                    foreach ($imageIds as $size => $imageId) {
                        $dimensions = $this->viewConfigHelper->getImageSize($imageId);
                        $imgixUrl = $this->image->getCustomUrl($image->getUrl(), $dimensions['width'], $dimensions['height']);

                        switch ($size) {
                            case 'small':
                                $image->setSmallImageUrl($imgixUrl);
                                break;
                            case 'medium':
                                $image->setMediumImageUrl($imgixUrl);
                                break;
                            case 'large':
                                $image->setLargeImageUrl($imgixUrl);
                                break;
                            default:
                                $image->setUrl($imgixUrl);
                                break;
                        }
                    }
                }
            }

            return $images;
        } catch (\Exception $e) {
            return $images;
        }
    }

}
