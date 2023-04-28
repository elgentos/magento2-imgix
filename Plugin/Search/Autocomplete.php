<?php

namespace Elgentos\Imgix\Plugin\Search;

use Magento\Framework\Controller\ResultFactory;

class Autocomplete
{
    private $image;
    private $viewConfigHelper;

    public function __construct(
        \Elgentos\Imgix\Model\Image $image,
        \Elgentos\Imgix\Helper\ViewConfigHelper $viewConfigHelper
    )
    {
        $this->image = $image;
        $this->viewConfigHelper = $viewConfigHelper;
    }

    public function afterGetItems($subject, array $resultItems)
    {
        if (!$this->image->isServiceEnabled()) {
            return $resultItems;
        }

        foreach ($resultItems as $item) {
            if (!$item->getData('image')) {
                continue;
            }
            $imageId = $item->getData('image_id');
            if (!$imageId) {
                $imageId = 'product_page_image_small'; // Fallback to default image ID
            }

            $dimensions = $this->viewConfigHelper->getImageSize($imageId);
            $imgixUrl = $this->image->getCustomUrl($item->getData('image'), $dimensions['width'], $dimensions['height']);
            $item->setData('image', $imgixUrl);
        }

        return $resultItems;
    }
}
