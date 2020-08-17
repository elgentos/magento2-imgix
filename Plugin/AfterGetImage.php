<?php

namespace Elgentos\Imgix\Plugin;

use Magento\Catalog\Block\Product\AbstractProduct;

class AfterGetImage
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

    /**
     * @param AbstractProduct $subject
     * @param $result
     * @param $product
     * @param $imageId
     * @param $attributes
     * @return mixed
     */
    public function afterGetImage(AbstractProduct $subject, $result, $product, $imageId, $attributes) {
        try {
            if ($product) {
                return $result;
            }
        } catch (\Exception $e) {
        }

        return $result;
    }
}
