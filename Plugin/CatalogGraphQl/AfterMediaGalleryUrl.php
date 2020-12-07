<?php

namespace Elgentos\Imgix\Plugin\CatalogGraphQl;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class AfterMediaGalleryUrl
{
    /**
     * @var \Elgentos\Imgix\Model\Image
     */
    private $image;

    public function __construct(
        \Elgentos\Imgix\Model\Image $image
    ) {
        $this->image = $image;
    }

    public function afterResolve(
        $subject,
        $result,
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if(empty($result)) {
            return $result;
        }

        if (isset($value['image_type'])) {
            if($value['image_type'] ==  'small_image' || $value['image_type'] ==  'thumbnail') {
                return $this->image->getSmallUrl($result);
            }
            return $this->image->getDefaultUrl($result);
        } elseif (isset($value['file'])) {
            return $this->image->getDefaultUrl($result);
        }
    }
}
