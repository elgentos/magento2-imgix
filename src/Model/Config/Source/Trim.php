<?php

declare(strict_types=1);

namespace Elgentos\Imgproxy\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Trim implements OptionSourceInterface
{
    public const MODE_EMPTY = '',
        MODE_AUTO = 'auto',
        MODE_COLOR = 'color';

    private const AVAILABLE_MODES = [
        self::MODE_EMPTY => 'No Trim',
        self::MODE_AUTO => 'Auto',
        self::MODE_COLOR => 'Color'
    ];

    public function toOptionArray(): array
    {
        return array_map(
            static fn (string $value, string $label) => [
                'value' => $value,
                'label' => $label
            ],
            array_keys(self::AVAILABLE_MODES),
            array_values(self::AVAILABLE_MODES)
        );
    }
}
