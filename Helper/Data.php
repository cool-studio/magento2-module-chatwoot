<?php
/**
 * Chatwoot integration for Magento
 *
 * @package CoolStudio_Chatwoot
 */

namespace CoolStudio\Chatwoot\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Encryption\EncryptorInterface;

class Data extends AbstractHelper
{
    /**
     * Config paths
     */
    const XML_PATH_ENABLED = 'chatwoot/general/enabled';
    const XML_PATH_WEBSITE_TOKEN = 'chatwoot/general/website_token';
    const XML_PATH_BASE_URL = 'chatwoot/general/base_url';
    const XML_PATH_HMAC_SECRET = 'chatwoot/general/hmac_secret';
    const XML_PATH_POSITION = 'chatwoot/general/position';
    const XML_PATH_WIDGET_TYPE = 'chatwoot/general/widget_type';
    const XML_PATH_LAUNCHER_TITLE = 'chatwoot/general/launcher_title';
    const XML_PATH_DARK_MODE = 'chatwoot/general/dark_mode';

    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var EncryptorInterface
     */
    protected $encryptor;

    /**
     * @param Context $context
     * @param CustomerSession $customerSession
     * @param EncryptorInterface $encryptor
     */
    public function __construct(
        Context $context,
        CustomerSession $customerSession,
        EncryptorInterface $encryptor
    ) {
        $this->customerSession = $customerSession;
        $this->encryptor = $encryptor;
        parent::__construct($context);
    }

    /**
     * Check if module is enabled
     *
     * @param null|string|int $storeId
     * @return bool
     */
    public function isEnabled($storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get website token
     *
     * @param null|string|int $storeId
     * @return string
     */
    public function getWebsiteToken($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_WEBSITE_TOKEN,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get base URL
     *
     * @param null|string|int $storeId
     * @return string
     */
    public function getBaseUrl($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BASE_URL,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get HMAC secret key
     *
     * @param null|string|int $storeId
     * @return string
     */
    public function getHmacSecret($storeId = null)
    {
        $value = $this->scopeConfig->getValue(
            self::XML_PATH_HMAC_SECRET,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
        
        if ($value) {
            return $this->encryptor->decrypt($value);
        }
        
        return '';
    }

    /**
     * Get widget position
     *
     * @param null|string|int $storeId
     * @return string
     */
    public function getPosition($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_POSITION,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get widget type
     *
     * @param null|string|int $storeId
     * @return string
     */
    public function getWidgetType($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_WIDGET_TYPE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get launcher title
     *
     * @param null|string|int $storeId
     * @return string
     */
    public function getLauncherTitle($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_LAUNCHER_TITLE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get dark mode setting
     *
     * @param null|string|int $storeId
     * @return string
     */
    public function getDarkMode($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_DARK_MODE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: 'auto';
    }

    /**
     * Get customer data for Chatwoot
     *
     * @return array
     */
    public function getCustomerData()
    {
        $data = [];
        if ($this->customerSession->isLoggedIn()) {
            $customer = $this->customerSession->getCustomer();
            $data = [
                'name' => $customer->getName(),
                'email' => $customer->getEmail(),
                'identifier' => $customer->getId()
            ];
        }
        return $data;
    }

    /**
     * Generate HMAC signature for user identity verification
     *
     * @param string $identifier Customer ID
     * @return string|null HMAC signature
     */
    public function generateHmacSignature($identifier)
    {
        $hmacSecret = $this->getHmacSecret();
        
        if (!$hmacSecret || !$identifier) {
            return null;
        }
        
        return hash_hmac('sha256', $identifier, $hmacSecret);
    }
} 