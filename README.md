# Chatwoot for Magento 2

![Chatwoot for Magento 2](https://img.shields.io/badge/Magento-2.4.x-orange.svg) ![License](https://img.shields.io/badge/license-OSL--3.0-blue.svg)

This module integrates the Chatwoot customer messaging platform with Magento 2, allowing you to provide seamless customer support directly on your store.

## Features

- ✅ Easy integration with Chatwoot
- ✅ Secure user identification with HMAC validation
- ✅ Customizable widget position (left/right)
- ✅ Multiple widget display types (standard/expanded)
- ✅ Custom launcher title support
- ✅ Dark mode support with auto/light options
- ✅ Real-time page tracking for better context
- ✅ Automatic customer information sync when logged in
- ✅ Full configuration through Magento admin

## Installation

### Via Composer (recommended)

```bash
composer require coolstudio/module-chatwoot
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy -f
bin/magento cache:flush
```

### Manual Installation

1. Create the following directory structure in your Magento installation:
   ```
   app/code/CoolStudio/Chatwoot
   ```

2. Download the module files and place them in this directory
   
3. Enable the module and update the database:
   ```bash
   bin/magento module:enable CoolStudio_Chatwoot
   bin/magento setup:upgrade
   bin/magento setup:di:compile
   bin/magento setup:static-content:deploy -f
   bin/magento cache:flush
   ```

## Configuration

1. Log in to your Magento Admin Panel
2. Navigate to **Stores** > **Configuration** > **Services** > **Chatwoot**
3. Configure the following settings:

| Setting | Description |
|---------|-------------|
| Enable Chatwoot | Enables/disables the module |
| Website Token | Your Chatwoot website token (found in Chatwoot dashboard) |
| Base URL | Your Chatwoot instance URL (e.g., https://app.chatwoot.com) |
| HMAC Secret Key | Secret key for secure user identification (optional) |
| Widget Position | Position of the widget (left/right) |
| Widget Type | Standard or Expanded bubble display |
| Launcher Title | Custom text for the chat widget when closed |
| Dark Mode | Choose between auto (system preference) or light mode |

## Setting up HMAC Identity Validation

For enhanced security, you can enable HMAC validation:

1. In your Chatwoot dashboard, go to **Settings** > **Inboxes** > **Select your inbox** > **Widget Settings**
2. Enable "Identity Validation" to get your secret key
3. Copy this key to the Magento admin configuration

HMAC validation ensures that user identities are authentic and cannot be spoofed.

## Features in Detail

### Dark Mode
The widget can adapt to your users' preferences:
- `auto`: Automatically matches the user's system theme
- `light`: Forces light mode regardless of system settings

### Page Tracking
Support agents can see which page a customer is currently viewing, helping provide more contextual assistance. This works for both:
- Logged-in customers
- Guest visitors

## Support

For issues, feature requests, or questions:

- Open an issue on [GitHub](https://github.com/coolstudio/magento2-chatwoot)

## License

This module is licensed under the Open Software License v. 3.0 (OSL-3.0).

---

&copy; 2025 CoolStudio. All rights reserved.
