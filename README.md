# Custom WordPress Development Theme

Welcome to the **Custom WordPress Development Theme**! This theme is tailored for building modern, highly customizable, and visually engaging WordPress sites. It integrates advanced features like custom Gutenberg blocks, animations, and dynamic content rendering, all while maintaining a clean and modular structure.

## 🚀 Features
- **Custom Gutenberg Blocks**: Predefined blocks like Hero, Accordion, CTA, Gallery Grid, and more.
- **Dynamic Content Rendering**: Utilizes Advanced Custom Fields (ACF) for flexible content management.
- **Responsive Design**: Mobile-first, fully responsive layout.
- **GSAP Animations**: Smooth animations for various components.
- **Custom Navigation Menus**: Enhanced menu options with descriptions and icons.
- **Lightweight and Modular CSS**: Organized block-specific and global styles.

## 📂 Project Structure
```
custom-dev-theme/
│
├── css/                   # Stylesheets
│   ├── blocks/            # Styles for custom blocks
│   │   ├── accordion.css  # Accordion block styles
│   │   ├── cta.css        # Call-to-action block styles
│   │   ├── ...            # More block-specific styles
│   ├── admin-menu-styles.css
│   ├── editor-styles.css
│   ├── footer.css
│   ├── header.css
│   └── style.css          # Theme information and global styles
│
├── img/                   # Theme images
├── inc/                   # PHP includes
│   ├── admin.php          # Admin-specific configurations
│   ├── block-registration.php # Custom Gutenberg blocks registration
│   ├── class-custom-menu-walker.php # Custom menu walker class
│   ├── enqueue-scripts.php # Enqueues styles and scripts
│   ├── menu.php           # Custom menu functions
│   └── render-callbacks.php # ACF block render callbacks
│
├── js/                    # JavaScript files
│   ├── custom-nav-fields.js # Handles custom menu fields
│   └── main.js            # Core theme JavaScript
│
├── screenshot.jpg         # Theme screenshot
├── footer.php             # Footer template
├── functions.php          # Theme setup and includes
├── header.php             # Header template
├── index.php              # Main template file
├── page.php               # Page template
├── style.css              # Main stylesheet (theme info)
└── README.md              # Theme documentation
```

## 🛠️ Getting Started

### Installation
1. Download or clone the theme into your WordPress `wp-content/themes/` directory:
   ```bash
   git clone https://github.com/yourusername/custom-dev-theme.git
   ```

2. Activate the theme in the WordPress admin dashboard under **Appearance > Themes**.

3. Ensure the required plugins (e.g., **ACF**) are installed and activated.

## 📦 Key Features Explained

### Custom Blocks
The theme comes with several pre-built custom blocks:
- **Accordion Block**: Expandable sections for FAQ or nested content.
- **Call-to-Action Block**: Engaging CTA with optional background images.
- **Gallery Grid Block**: Displays a gallery of images in a grid layout.
- **Hero Block**: Full-width hero sections with customizable backgrounds.

Blocks are registered in `inc/block-registration.php` and rendered using callbacks in `inc/render-callbacks.php`.

### Navigation Enhancements
Custom fields for menu items (icons and descriptions) are added via `menu.php` and handled in `js/custom-nav-fields.js`.

### GSAP and Scroll Animations
Smooth animations for various sections using GSAP and ScrollTrigger. Configured in `js/main.js`.

### Modular CSS
Block-specific styles are organized in the `css/blocks/` folder for maintainability.

## 🖋️ License
This project is licensed under the [MIT License](LICENSE).

---