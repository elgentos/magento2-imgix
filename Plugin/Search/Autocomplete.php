<?php

namespace Elgentos\Imgix\Plugin\Search;

use Magento\Framework\Controller\ResultFactory;

class Autocomplete
{
    private \Elgentos\Imgix\Model\Image $image;

    public function __construct(
        \Elgentos\Imgix\Model\Image $image
    )
    {
        $this->image = $image;
    }

    public function afterGetItems($subject, array $resultItems)
    {
        if (!$this->image->isServiceEnabled()) {
            return $resultItems;
        }

        foreach ($resultItems as $item) {
            $item->setData('image', $this->image->getAutoCompleteUrl($item->getData('image')));
        }

        return $resultItems;
    }
}
