<?php
/**
 * Chatwoot integration for Magento
 *
 * @package CoolStudio_Chatwoot
 */

namespace CoolStudio\Chatwoot\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class DarkMode implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'auto', 'label' => __('Auto')],
            ['value' => 'light', 'label' => __('Light')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'auto' => __('Auto'),
            'light' => __('Light')
        ];
    }
} 