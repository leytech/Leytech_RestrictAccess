## Restrict Access Extension for Magento

This extension restricts access to the store front depending on the visitor's IP address, or experimentally, depending on whether they are logged in to the admin area and have appropriate permissions.

It is useful for staging sites, pre-launch, or other times where you don't wish the public to browse a site.

Be very careful using it on a production site. You almost certainly don't want to block public traffic to your site! If your site is down for maintenance you should use more suitable techniques such as maintenance mode or a properly configured holding page.

### Features

- Restricts access to the store front.
- Allow access from specific IP addresses (whitelist).
- Allow access from users who are logged in to the admin area (experimental)*
- Uses no Model or Block rewrites!
- Requires no additional web server configuration.
- Shows a notice in the admin area when enabled so you don't leave it enabled by mistake.
- Clean code.

***Note:** allowing access for admin users requires the [Magento Cross Area Sessions](https://github.com/astorm/Magento_CrossAreaSessions) extension provided by Alan Storm.

### Compatibility

Tested on Magento CE 1.9.3.2. Should work on lower versions and equivalent EE. 

### How to use?

Enable and configure the extension under System -> Configuration -> Leytech Extensions.

### Screenshots

Maybe coming soon...

### To do

1. Nothing really. Feature requests welcome.

### Support

This extension is provided free of charge as-is. We don't provide free support.

### Contribute

Pull requests and feedback welcome.