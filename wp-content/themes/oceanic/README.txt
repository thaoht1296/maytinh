=== Oceanic ===
Contributors: Freelancelot
Donate link: 
Tags: one-column, two-columns, right-sidebar, custom-background, custom-colors, custom-header, custom-menu, featured-images, full-width-template, theme-options, threaded-comments, translation-ready, blog, e-commerce, holiday
Requires at least: 4.5
Tested up to: 5.3.2
Requires PHP: 5.3
Stable tag: 3.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Oceanic is a responsive WordPress theme with an ocean-inspired design. Integrated with some powerful plugins such as Site Origin's Page Builder and Contact Form 7 as well as being Woocommerce-ready, Oceanic has everything you need to hit the beach running.

== License ==

Oceanic WordPress Theme, Copyright 2019 Freelancelot.
Oceanic is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/copyleft/gpl.html.
Oceanic WordPress Theme is derived from Underscores WordPress Theme, Copyright 2012 Automattic http://underscores.me/ Underscores WordPress Theme is distributed under the terms of the GNU GPL.
All Javascript is located in /js/ with license headers where appropriate.

== Bundled Licenses ==

jQuery Waypoints - v2.0.3
Copyright (c) 2011-2013 Caleb Troughton
https://github.com/imakewebthings/waypoints/blob/master/licenses.txt

jQuery carouFredSel 6.2.1
Copyright (c) 2013 Fred Heusschen
http://en.wikipedia.org/wiki/MIT_License
http://en.wikipedia.org/wiki/GNU_General_Public_License

FontAwesome - Copyright 2012 Dave Gandy
Font License
License: SIL OFL 1.1
Code License
License: MIT License
http://fontawesome.io/license/

* The Photo in screenshot.png is from unsplash.com and licensed Creative Commons 0 (CC0)
* Photos in the Oceanic demo site are from unsplash.com and licensed Creative Commons 0 (CC0)
* Photos in the Oceanic demo slider are from unsplash.com and licensed Creative Commons 0 (CC0)
Unsplash - Distributed under the terms of CC0 1.0 Universal License (Public Domain).
https://unsplash.com/license

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's zip file. Click Install Now.
3. Click Activate to use your new theme right away.


Oceanic's Customizer Settings:
------------------------------
The theme settings are built into the WordPress Customizer using "Customizer Library" by Devin Price, situated in /customizer/.
license: GPL 2.0+
https://github.com/devinsays/customizer-library/blob/master/composer.json

The Oceanic Premium upgrade situated in /upgrade/ displays the features that the premium version includes.
Oceanic Premium version is licensed under GPL 2.0+

All setting are self explanatory or have notes explaining what they do or how to use the theme settings.
View the theme settings under "Appearance" -> Customize.

= Quick Specs (all measurements in pixels) =

1. Featured Images work best at a minimum of 1100 wide and 420 high.

== Changelog ==

#### 1.0.19
* New: Added a loader animation to the thumbnails on the shop page
* Tweak: Reorganized the Styling settings into a Colors section and a Fonts section

#### 1.0.18
* New: Added a setting to set the number of products displayed per page
* New: Added styling for the Yotpo Reviews for Woocommerce plugin
* New: Added support for the WooCommerce setting that allows the user to set the number of products per row
* New: Replaced the "read more" button with a text notice on out of stock products
* New: Added a theme setting to set the product catalog page to full width
* New: Added a theme setting to set the product page to full width
* New: Added a theme setting to set the product category and tag pages to full width
* New: Added a theme setting to disable the product image zoom functionality
* Tweak: Improved the styling for WooCommerce

#### 1.0.17
* New: Added styling for the Social Slider Widget plugin
* New: Added styling to make the input border color when focused the Primary Color
* New: Added styling to make the text selected color the Primary Color
* New: Added styling for the WooCommerce My Account sidebar

#### 1.0.16
* New: Added a Left Sidebar page template
* New: Added a Full Width, No Bottom Margin page template
* Tweak: Changed add_to_cart_fragments to woocommerce_add_to_cart_fragments
* Tweak: Refactored the header cart to not use deprecated WooCommerce functions
* Tweak: Updated functions.php to only include the custom WooCommerce stylesheet if WooCommerce is active
* Tweak: Updated the styling of the comment form
* Tweak: Deleted the file custom-header.php as it's not needed
* Fix: Fixed a styling issue with the comments cookies opt-in checkbox

#### 1.0.15
* New: Added styling for the Gallery by Supsystic plugin
* New: Added styling for the Recent Posts Extended Widget plugin
* New: Added styling for the new and improved demo site homepage layout

#### 1.0.14
* New: Added support for the new wp_body_open hook
* Tweak: Removed the custom code and theme setting for adding a favicon as this is now handled by the Site Icon
* Tweak: Added the TGM Plugin Activation plugin for handling recommended plugins
* Tweak: Added the Requires at least and Requires PHP field to the readme file
* Fix: Fixed a PHP notice occurring on the homepage

#### 1.0.13
* Removed functions required for outdated versions of WordPress

#### 1.0.12
* Maintenance update

#### 1.0.11
* Fixed some issues with the styling of the WooCommerce pages

#### 1.0.10
* Fixed an issue with the WooCommerce checkout page for mobile
* Added a missing comma to the stylesheet
* Added functionality to set a menu item as not clickable by making the URL a hash character

#### 1.0.9
* Fixed a glitch with the cascading of the mobile navigation menu
* Added an option to display a top bar when using the centered layout
* Fixed a glitch with setting the color of the em tag in the header
* Updated the mobile menu design
* Fixed a glitch where the header image wasn't centering for mobile when using the standard layout
* Added JavaScript code to sanitize the Slide Transition Speed and Slideshow Speed options which were causing errors if left empty
* Removed reference to a custom nav menu that doesn't exist in header-layout-centered.php
* Tweaked the styles for the left and centered header layouts
* Fixed a glitch where the submenu option rollovers weren't extending to the full width of the submenu
* Added an intendation for the 4th level submenu of the mobile menu
* Refactored the Site Title and Description HTML to not use H1 and H2 tags
* Switched the body font and heading font settings around on the Customize page as it's more logical
* Removed the maximum height from the site logo when using the centered layout as this was interfering with the use of larger logos
* Fixed a glitch with the styling of the color-text class
* Updated the theme options page
* Updated the upgrade page
* Updated the translation file

#### 1.0.8
* Fixed a glitch with string translation
* Fixed a glitch with multiple text-domains
* Updated the translation file

#### 1.0.7
* Fixed a glitch with multiple text-domains
* Updated the translation file

#### 1.0.6
* Updated the translation file

#### 1.0.5
* Fixed a glitch with the submenu
* Fixed a glitch where posts in the slider categories weren't being excluded from the blog when the blog was the front page  
* Fixed a glitch where the body font option wasn't affecting links in the footer widgets
* Fixed a glitch where the slider was disappearing behind the header on page resize when sticky header was enabled
* Implemented a minimum width on the slider image to prevent it getting too small
* Enabled flex width and flex height for the custom header
* Styling update for Woocommerce
* Fixed a glitch with the styling of the em tag
* Fixed a glitch with the styling of the em tag in the editor stylesheet
* Fixed a typo on the theme options page
* Added an option to set the slide transition speed
* Added an extra style to the stylesheet for displaying colored text
* Updated the upgrade page

#### 1.0.4
* Fixed a bug with the favicon option

#### 1.0.3
* Updated the upgrade page

#### 1.0.2
* Fixed a PHP notice occurring in single.php
* Updated the theme tags
* Updated the FontAwesome license declaration
* Fixed a bug with the 404 text option not working
* Replaced instances of the sanitize_hex_color function in styles.php with the esc_html function
* Removed some commented out code from comments.php
* Added WYSIWYG editor styling

#### 1.0.1
* Updated the styling of sidebar dropdown lists
* Added Breadcrumb NavXT to single.php
* Fixed a typo in functions.php 

#### 1.0.0
* Initial release
