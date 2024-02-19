<?php

declare(strict_types=1);

namespace Elgentos\Imgproxy\Plugin;

use Elgentos\Imgproxy\Model\Image as ImgproxyImage;
use Magento\Catalog\Model\View\Asset\Image;

class AssetImagePlugin
{
    public function __construct(
        protected readonly ImgproxyImage $image,
    )
    { }

    /**
     * Change the custom URL
     *
     * @return bool
     */
    public function afterGetUrl(Image $subject, $result)
    {
        $params = $subject->getImageTransformationParameters();

        return $this->image->getCustomUrl($result, (int) $params['width'], (int) $params['height']);
    }
}
