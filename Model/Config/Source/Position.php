<?php
/**
 * Chatwoot integration for Magento
 *
 * @package CoolStudio_Chatwoot
 */

namespace CoolStudio\Chatwoot\Model\Config\Source;

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