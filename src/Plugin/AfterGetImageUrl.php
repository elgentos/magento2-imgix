<?php

declare(strict_types=1);

namespace Elgentos\Imgix\Plugin;

use Elgentos\Imgix\Model\Config;
use Elgentos\Imgix\Model\Image as ImgixImage;
use Exception;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Image;
use Magento\Catalog\Helper\ImageFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Elgentos\Imgix\Helper\ViewConfigHelper as ViewConfig;

// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
// phpcs:disable Generic.NamingConventions.CamelCapsFunctionName.ScopeNotCamelCaps

class AfterGetImageUrl
{
    protected ImgixImage $image;

    protected ProductRepositoryInterface $productRepository;

    protected ImageFactory $imageHelperFactory;

    protected ViewConfig $viewConfigHelper;

    private Config $config;

    public function __construct(
        ImgixImage $image,
        ProductRepositoryInterface $productRepository,
        ImageFactory $imageHelperFactory,
        ViewConfig $viewConfigHelper,
        Config $config
    ) {
        $this->image = $image;
        $this->productRepository = $productRepository;
        $this->imageHelperFactory = $imageHelperFactory;
        $this->viewConfigHelper = $viewConfigHelper;
        $this->config = $config;
    }

    public function after__call(
        Image $image,
        $result,
        string $method
    ) {
        if ($method !== 'getImageUrl') {
            return $result;
        }

        if (!$this->config->isEnabled()) {
            return $result;
        }

        if ($image->getData('product_id') === 0) {
            return $result;
        }

        $imageId = $image->getData('image_id');

        if (!$imageId) {
            return $result;
        }

        $dimensions   = $this->viewConfigHelper->getImageSize($imageId);

        try {
            $defaultImage = $this->getDefaultImageUrl($image->getData('product_id'));

            if (!$defaultImage) {
                return $result;
            }

            return $this->image->getCustomUrl(
                $defaultImage,
                $dimensions['width'],
                $dimensions['height']
            );
        } catch (Exception $e) {
            return $result;
        }
    }

    public function getDefaultImageUrl(int $productId): ?string
    {
        $product = $this->getProductById($productId);

        if (!$product instanceof ProductInterface) {
            return null;
        }

        return $this->imageHelperFactory->create()
            ->init($product, 'product_page_main_image')
            ->getUrl();
    }

    public function getProductById(int $id): ?ProductInterface
    {
        try {
            return $this->productRepository->getById($id);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }
}
