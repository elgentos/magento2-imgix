<?php

namespace Elgentos\Imgix\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Fit implements OptionSourceInterface
{
    public const MODE_CLAMP = 'clamp',
        MODE_CLIP = 'clip',
        MODE_CROP = 'crop',
        MODE_FACE_AREA = 'facearea',
        MODE_FILL = 'fill',
        MODE_FILL_MAX = 'fillmax',
        MODE_MAX = 'max',
        MODE_MIN = 'min',
        MODE_SCALE = 'scale';

    private const AVAILABLE_MODES = [
        self::MODE_CLAMP => 'Clamp',
        self::MODE_CLIP => 'Clip (Default)',
        self::MODE_CROP => 'Crop',
        self::MODE_FACE_AREA => 'Face Area',
        self::MODE_FILL => 'Fill',
        self::MODE_FILL_MAX => 'Fill Max',
        self::MODE_MAX => 'Max',
        self::MODE_MIN => 'Min',
        self::MODE_SCALE => 'Scale',
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
