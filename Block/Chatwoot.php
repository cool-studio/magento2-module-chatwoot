<?php
/**
 * Chatwoot integration for Magento
 *
 * @package CoolStudio_Chatwoot
 */

namespace CoolStudio\Chatwoot\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use CoolStudio\Chatwoot\Helper\Data;
use Magento\Framework\Serialize\Serializer\Json;

class Chatwoot extends Template
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var Json
     */
    protected $json;

    /**
     * @param Context $context
     * @param Data $helper
     * @param Json $json
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helper,
        Json $json,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->json = $json;
        parent::__construct($context, $data);
    }

    /**
     * Check if Chatwoot is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helper->isEnabled();
    }

    /**
     * Get website token
     *
     * @return string
     */
    public function getWebsiteToken()
    {
        return $this->helper->getWebsiteToken();
    }

    /**
     * Get base URL
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->helper->getBaseUrl();
    }

    /**
     * Check if HMAC verification is available
     *
     * @return bool
     */
    public function hasHmacVerification()
    {
        return (bool)$this->helper->getHmacSecret();
    }

    /**
     * Get widget position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->helper->getPosition();
    }

    /**
     * Get widget type
     *
     * @return string
     */
    public function getWidgetType()
    {
        return $this->helper->getWidgetType();
    }

    /**
     * Get launcher title
     *
     * @return string
     */
    public function getLauncherTitle()
    {
        return $this->helper->getLauncherTitle();
    }

    /**
     * Get customer data with HMAC signature for Chatwoot
     *
     * @return array
     */
    public function getCustomerDataWithHmac()
    {
        $customerData = $this->helper->getCustomerData();
        
        if (isset($customerData['identifier']) && $this->hasHmacVerification()) {
            $customerData['hmacSignature'] = $this->helper->generateHmacSignature($customerData['identifier']);
        }
        
        return $customerData;
    }

    /**
     * Get customer data as JSON
     *
     * @return string
     */
    public function getCustomerDataJson()
    {
        return $this->json->serialize($this->getCustomerDataWithHmac());
    }

    /**
     * Get Chatwoot config options
     *
     * @return array
     */
    public function getChatwootConfigOptions()
    {
        $options = [
            'websiteToken' => $this->getWebsiteToken(),
            'baseUrl' => $this->getBaseUrl()
        ];

        // Add optional parameters if they are set
        if ($position = $this->getPosition()) {
            $options['position'] = $position;
        }
        
        if ($widgetType = $this->getWidgetType()) {
            $options['type'] = $widgetType;
        }
        
        if ($launcherTitle = $this->getLauncherTitle()) {
            $options['launcherTitle'] = $launcherTitle;
        }
        
        return $options;
    }

    /**
     * Get Chatwoot config options as JSON
     * 
     * @return string
     */
    public function getChatwootConfigJson()
    {
        return $this->json->serialize($this->getChatwootConfigOptions());
    }
} 