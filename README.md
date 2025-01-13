# WHMCS Game Servers Plugin

A powerful WHMCS plugin that adds game server management capabilities to your hosting business. This plugin creates a beautiful, modern interface for selling game server hosting services with customizable product options, image galleries, and YouTube video integration.

## Features

- 🎮 Dedicated game server product type
- 🖼️ Image upload system for game banners
- 🎥 YouTube video integration
- 📝 Rich text descriptions and feature lists
- 🛒 Custom cart interface
- 💰 Flexible pricing options
- 🔧 Configurable server options
- 📱 Fully responsive design

## Installation

1. Download the plugin files
2. Upload the `gameservers` folder to your WHMCS installation's `modules/addons` directory
3. Log in to your WHMCS admin area
4. Go to Setup > Addon Modules
5. Find "Game Servers" and click Activate
6. Configure the plugin settings (YouTube API key if needed)

## Usage

### Setting Up Game Server Products

1. Go to Setup > Products/Services
2. Create a new product group for game servers (optional)
3. Create a new product
4. Configure the product pricing and options as needed

### Adding Game Server Details

1. Go to Addons > Game Servers in the admin area
2. Click "Add New Game Server"
3. Fill in the details:
   - Select the associated product
   - Enter game name
   - Add description
   - List features (HTML supported)
   - Upload banner image or provide image URL
   - Add YouTube video ID (optional)
4. Click Save

### Client Area Features

Your clients will see:
- A dedicated Game Servers page listing all available servers
- Detailed server pages with:
  - High-quality banner images
  - Game descriptions
  - Feature lists
  - YouTube video previews
  - Pricing options
- Custom cart interface showing:
  - Server details
  - Configuration options
  - Available addons
  - Billing cycles

## Directory Structure

```
gameservers/
├── README.md
├── gameservers.php          # Main plugin file
├── includes/
│   ├── manage.php          # Admin management interface
│   ├── overview.php        # Admin overview page
│   └── upload.php          # Image upload handler
├── templates/
│   ├── cart.tpl           # Custom cart template
│   ├── gamedetails.tpl    # Game details page
│   └── gameservers.tpl    # Game servers listing
└── uploads/               # Image upload directory
```

## Requirements

- WHMCS version 7.0 or higher
- PHP 7.2 or higher
- GD Library (for image processing)
- Write permissions for the uploads directory

## Security Features

- Secure image upload system
- File type validation
- File size limits
- XSS protection
- CSRF protection (via WHMCS)

## Customization

The plugin uses Bootstrap 4 and modern CSS for styling. You can customize the appearance by:

1. Editing the template files in the `templates` directory
2. Modifying the CSS within each template
3. Adding custom JavaScript as needed

## Support

For support, feature requests, or bug reports, please contact us through:
- Our support ticket system
- Email: your@email.com
- Documentation: [Your Documentation URL]

## License

[Your License Information]

## Version History

- 1.0.0 - Initial release
  - Basic game server management
  - Image upload system
  - Custom cart interface

## Credits

Developed by [Your Company/Name]
