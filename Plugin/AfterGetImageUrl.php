<?php

namespace Elgentos\Imgix\Plugin;

class AfterGetImageUrl
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

    public function after__call(\Magento\Catalog\Block\Product\Image $image, $result, $method)
    {
        try {
            if ($method == 'getImageUrl' && $image->getProductId() > 0) {
                if ($image->getHeight() < 300 || $image->getWidth() < 300) {
                    return $this->image->getSmallUrl($result);
                }
                return $this->image->getDefaultUrl($result);
            }
        } catch (\Exception $e) {
        }

        return $result;
    }
}
