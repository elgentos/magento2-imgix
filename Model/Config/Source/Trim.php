<?php

namespace Elgentos\Imgix\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Trim implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => '', 'label' => __('No Trim')],
            ['value' => 'auto', 'label' => __('Auto')],
            ['value' => 'color', 'label' => __('Color')]
        ];
    }
}
