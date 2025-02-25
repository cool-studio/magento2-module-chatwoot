<?php
/**
 * ChatWoot integration for Magento
 *
 * @package CoolStudio_ChatWoot
 */

namespace CoolStudio\ChatWoot\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class WidgetType implements OptionSourceInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'standard', 'label' => __('Standard')],
            ['value' => 'expanded_bubble', 'label' => __('Expanded Bubble')]
        ];
    }
} 