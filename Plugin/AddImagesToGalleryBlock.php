<?php

namespace Elgentos\Imgix\Plugin;

use Magento\Catalog\Block\Product\View\Gallery;
use Magento\Framework\Data\Collection;
use Magento\Framework\Data\CollectionFactory;
use Magento\Framework\DataObject;

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
     * AddImagesToGalleryBlock constructor.
     *
     * @param \Elgentos\Imgix\Model\Image $image
     * @param CollectionFactory $dataCollectionFactory
     */
    public function __construct(
        \Elgentos\Imgix\Model\Image $image,
        CollectionFactory $dataCollectionFactory
    ) {
        $this->dataCollectionFactory = $dataCollectionFactory;
        $this->image = $image;
    }

    public function afterGetGalleryImages(Gallery $subject, $images)
    {
        try {
            foreach ($images as $image) {
                $image->setUrl($this->image->getDefaultUrl($image->getUrl()));
                $image->setSmallImageUrl($this->image->getSmallUrl($image->getSmallImageUrl()));
                $image->setMediumImageUrl($this->image->getDefaultUrl($image->getMediumImageUrl()));
                $image->setLargeImageUrl($this->image->getDefaultUrl($image->getMediumImageUrl()));
            }

            return $images;
        } catch (\Exception $e) {
            return $images;
        }
    }
}
