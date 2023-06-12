<?php

declare(strict_types=1);

namespace Elgentos\Imgix\Plugin\Search;

use Elgentos\Imgix\Helper\ViewConfigHelper;
use Elgentos\Imgix\Model\Config;
use Elgentos\Imgix\Model\Image;
use Magento\Search\Model\Autocomplete as AutocompleteModel;

class Autocomplete
{
    private Config $config;

    private Image $image;

    private ViewConfigHelper $viewConfigHelper;

    public function __construct(
        Config $config,
        Image $image,
        ViewConfigHelper $viewConfigHelper
    ) {
        $this->image = $image;
        $this->viewConfigHelper = $viewConfigHelper;
        $this->config = $config;
    }

    public function afterGetItems(
        AutocompleteModel $subject,
        array $result
    ): array {
        if (!$this->config->isEnabled()) {
            return $result;
        }

        foreach ($result as $item) {
            if (!$item->getData('image')) {
                continue;
            }

            $dimensions = $this->viewConfigHelper
                ->getImageSize($item->getData('image_id') ?: 'product_page_image_small');

            $item->setData(
                'image',
                $this->image->getCustomUrl(
                    $item->getData('image'),
                    $dimensions['width'],
                    $dimensions['height']
                )
            );
        }

        return $result;
    }
}
