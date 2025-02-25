<?php
/**
 * ChatWoot integration for Magento
 *
 * @package CoolStudio_ChatWoot
 */

namespace CoolStudio\ChatWoot\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Position implements OptionSourceInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'left', 'label' => __('Left')],
            ['value' => 'right', 'label' => __('Right')]
        ];
    }
} 