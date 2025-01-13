# WHMCS Game Servers Module

A powerful WHMCS addon module that adds game server management capabilities to your hosting business. This module creates a beautiful, modern interface for selling game server hosting services with customizable product options, image galleries, and YouTube video integration.

## Features

- 🎮 Dedicated game server product type
- 🖼️ Image upload system for game banners
- 🎥 YouTube video integration (direct URL support)
- 📝 Rich text descriptions and feature lists
- 🛒 Custom cart interface
- 💰 Flexible pricing options
- 🔧 Configurable server options
- 📱 Fully responsive design

## Important URLs

### Client Area
- Main Game Servers List: `yourwhmcs.com/index.php?m=gameservers`
- View Specific Game Server: `yourwhmcs.com/index.php?m=gameservers&action=view&id=X` (replace X with server ID)
- Order Page: `yourwhmcs.com/cart.php?a=add&pid=X` (replace X with product ID)

### Admin Area
- Module Settings: `yourwhmcs.com/admin/configaddonmods.php`
- Manage Game Servers: `yourwhmcs.com/admin/addonmodules.php?module=gameservers`

## Installation

1. Download the module files
2. Upload the `gameservers` folder to your WHMCS installation's `modules/addons` directory
   - The final path should be: `your-whmcs-path/modules/addons/gameservers/`
3. Make sure the `uploads` directory has write permissions (chmod 755 or 775)
4. Log in to your WHMCS admin area
5. Go to Setup > Addon Modules
6. Find "Game Servers" and click Activate
7. Access the module from Addons > Game Servers in the admin area

### Important Note
Make sure the module is placed in the correct directory path. WHMCS modules must be in specific directories:
- Addon Modules: `modules/addons/`
- Payment Gateways: `modules/gateways/`
- Server Modules: `modules/servers/`
- Registrar Modules: `modules/registrars/`

## Recent Changes

### Version 1.1.0
- Simplified YouTube video integration
  - Now accepts full YouTube URLs instead of requiring video IDs
  - Supports both standard (youtube.com/watch?v=) and short (youtu.be/) URLs
  - Removed YouTube API key requirement
- Fixed template issues
  - Updated to use object notation instead of array notation
  - Improved error handling in templates
  - Enhanced responsive design
- Improved pricing display
  - Streamlined order button
  - Simplified pricing plans layout
- Added proper directory structure documentation
- Updated installation instructions with correct paths

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
   - Add YouTube video URL (full URL supported)
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
├── gameservers.php          # Main module file
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

## Support

For support, feature requests, or bug reports, please contact:
- Email: support@gnzserver.com
- Website: https://gnzserver.com

## License

Copyright (c) 2024 GNZServer. All rights reserved.

## Credits

Developed by Goatboy @ GNZServer
