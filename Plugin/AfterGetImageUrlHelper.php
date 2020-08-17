<?php

namespace Elgentos\Imgix\Plugin;

class AfterGetImageUrlHelper
{
    /**
     * @var \Elgentos\Imgix\Model\Image
     */
    protected $image;

    public function __construct(
        \Elgentos\Imgix\Model\Image $image
    ) {
        $this->image = $image;
    }

    public function afterGetImageUrl($subject, $result, $product, $imageTypeId = 'product_base_image', $w = null, $h = null)
    {
        if ($h < 300 || $w < 300) {
            return $this->image->getSmallUrl($result);
        }

        return $this->image->getDefaultUrl($result);
    }
}
