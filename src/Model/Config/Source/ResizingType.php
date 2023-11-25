<?php

namespace Elgentos\Imgproxy\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class ResizingType implements ArrayInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'fit', 'label' => __('Fit')],
            ['value' => 'fill', 'label' => __('Fill')],
            ['value' => 'fill-down', 'label' => __('Fill-Down')],
            ['value' => 'force', 'label' => __('Force')],
            ['value' => 'auto', 'label' => __('Auto')]
        ];
    }
}
