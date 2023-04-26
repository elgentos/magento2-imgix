<?php

namespace Elgentos\Imgix\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;
use Elgentos\Imgix\Helper\ViewConfigHelper as ViewConfig;

class AfterGetImageUrl
{
    /**
     * @var \Elgentos\Imgix\Model\Image
     */
    protected $image;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var \Magento\Catalog\Helper\ImageFactory
     */
    protected $imageHelperFactory;

    /**
     * @var ViewConfig
     */
    protected $viewConfigHelper;

    public function __construct(
        \Elgentos\Imgix\Model\Image $image,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Helper\ImageFactory $imageHelperFactory,
        ViewConfig $viewConfigHelper
    ) {
        $this->image = $image;
        $this->productRepository = $productRepository;
        $this->imageHelperFactory = $imageHelperFactory;
        $this->viewConfigHelper = $viewConfigHelper;
    }

    public function after__call(\Magento\Catalog\Block\Product\Image $image, $result, $method)
    {
        if(! $this->image->isServiceEnabled()) {
            return $result;
        }

        try {
            if ($method == 'getImageUrl' && $image->getProductId() > 0) {
                $imageId = $image->getImageId();
                if (!$imageId) {
                    return $result;
                }

                $dimensions = $this->viewConfigHelper->getImageSize($imageId);

                $defaultImage = $this->getDefaultImageUrl($image->getProductId());
                if (!$defaultImage) {
                    return $result;
                }

                return $this->image->getCustomUrl($defaultImage, $dimensions['width'], $dimensions['height']);
            }

        } catch (\Exception $e) {
        }

        return $result;
    }

    public function getDefaultImageUrl(int $productId): ?string {
        $product = $this->getProductById($productId);
        if(! $product) {
            return null;
        }

        return $this->imageHelperFactory->create()
            ->init($product, 'product_page_main_image')->getUrl();
    }

    /**
     * @param $id
     * @return \Magento\Catalog\Api\Data\ProductInterface
     * @throws NoSuchEntityException
     */
    public function getProductById($id)
    {
        try {
            return $this->productRepository->getById($id);
        } catch (NoSuchEntityException $noSuchEntityException) {
            return null;
        }
    }
}
