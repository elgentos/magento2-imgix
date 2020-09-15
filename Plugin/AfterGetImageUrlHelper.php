<?php

namespace Elgentos\Imgix\Plugin;

class AfterGetImageUrlHelper
{
    /**
     * @var \Elgentos\Imgix\Model\Image
     */
    protected $image;

    /**
     * @var \Magento\Catalog\Helper\ImageFactory
     */
    protected $imageHelperFactory;

    public function __construct(
        \Elgentos\Imgix\Model\Image $image,
        \Magento\Catalog\Helper\ImageFactory $imageHelperFactory
    ) {
        $this->image = $image;
        $this->imageHelperFactory = $imageHelperFactory;
    }

    public function afterGetImageUrl(
        $subject,
        $result,
        $product,
        $imageTypeId = 'product_base_image',
        $w = null,
        $h = null
    ) {
        if (! $this->image->isServiceEnabled()) {
            return $result;
        }

        if ($h < 300 || $w < 300) {
            $defaultImage = $this->imageHelperFactory->create()
                ->init($product, 'product_page_main_image')->getUrl();
            return $this->image->getSmallUrl($defaultImage);
        }

        return $this->image->getDefaultUrl($result);
    }
}
