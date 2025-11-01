# WordPress Starter Theme

This is a starter theme for WordPress. It is based on the classic [underscores.me](https://underscores.me) starter theme, though several things have been changed, added, or removed.

**NOTE: This theme is meant for you to download and customize (if needed) for your own project. Limited support will be provided, other than fixing obvious bugs, typos, or adding any necessary features. No updates are pushed directly to users. Each download exists as a snapshot in time.**

## Development Setup

This theme uses [Node.js](https://nodejs.org/en/) and [Grunt](https://gruntjs.com) to manage dependencies and compile Sass, minify CSS and JS, and update the .pot file.

1. Install [Node.js](https://nodejs.org/en/) on your machine if you haven't already.
2. Install and activate the theme in WordPress.
3. Perform a search and replace for `wst` (lowercase) and `WST` (uppercase) to replace with your own theme slug and prefix.
4. Manually open the `assets/css/src/style.scss` file and update the theme name, author, and other information as needed.
5. Run `npm install` in the theme root directory to install dependencies.
6. Run `grunt watch` to automatically compile Sass, minify CSS and JS while working on the theme styles and scripts.
7. Run `grunt pot` to update the .pot file.

## Design Features

* Includes Bootstrap (CSS) utilities, grid, and reboot
* Includes Wide page template (page-width content column, no sidebar)
* Includes Narrow page template (centered, narrow content column, no sidebar) 
* Includes Page Sections page template (CSS optimized to use the Group block as a full-width page section with constrained content inside)
* Includes a blog template (home.php)
* Customizable page headers via WordPress core functionality (title and excerpt), custom page header function parameters in individual templates, or Advanced Custom Fields settings per page
* Desktop menu with drop-down support and mobile menu with expandable submenus on click
* Centered blog post layout with no sidebar for easy reading
* Condensed search results page layout
* Color scheme options in the Customizer, available for use in the Block Editor

### Styles and Scripts

With the theme activated and having run `npm install`, you may now run `grunt watch` in the theme root directory to automatically compile Sass, minify CSS and JS while working on the theme styles and scripts.

Styles and scripts should be edited in the `assets/css/src` and `assets/js/src` directories, respectively. The `assets/css` and `assets/js` directories are where the compiled and minified files are automatically placed. Any styles or scripts that you do not want to be compiled or minified should be placed directly in the `assets/css` and `assets/js` directories, respectively (or anywhere you want outside the `src` directories).

The `assets/css/styles.scss` and `assets/css/editor-styles.scss` files are the main Sass files that import all other Sass files. These files are then compiled to `style.css` and `editor-style.css`, respectively, and used for the theme.

The `assets/js/scripts.js` file is compiled from all files in the `assets/js/src` directory. This file is then minified to `assets/js/scripts.min.js` and used for the theme.

### HTML structure

The theme uses the [Bootstrap](https://getbootstrap.com/docs/5.3/layout/grid/) Grid system for layouts. The `.container`, `.row`, and `.col` classes are used throughout the theme to give structure.

However, the theme also has its own `.inner` class that provides vertical structure, best for creating page sections. A page section, in this context, is a horizontal section of the page that spans the entire width of the viewport. However, the content within the section is constrained to the page width. This works by combining the theme class with the Bootstrap classes. Example:

```html
<!-- Wrapper class - spans full viewport width -->
<section class="generic-section">

    <!-- Vertical structure class - adds vertical padding to page sections -->
    <div class="inner">

        <!-- Bootstrap Grid class - keeps content horizontally constrained -->
        <div class="container">

            <!-- Bootstrap Grid class - flex container -->
            <div class="row">
                
                <!-- Bootstrap Grid classes - flex items -->
                <div class="col-12 col-lg-6">
                    <p>Left column content</p>
                </div>
                <div class="col-12 col-lg-6">
                    <p>Right column content</p>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
</section>
```

The `.generic-section` element is the page section. The `.inner` element is the vertical structure. The `.container`, `.row`, and `.col` elements are the Bootstrap Grid system.

The `.inner` class also supports additional (optional) class modifiers to adjust the vertical padding. Those classes are `.tiny`, `.small`, `.medium`, `.large`, and `.huge`.

`<div class="inner tiny">` would create a relatively small page section while `<div class="inner huge">` would create a very large page section.

### Block Editor (Gutenberg) Page Sections

The above HTML structure is only achievable when you are the HTML author. However, the theme includes a style system which allows you to place a **Group** block into the *Page Sections* page template and the default structure of the block will inherit the page section style. No classes need to be added to the block for this to work. The Group block simply needs to:

1. Be placed in the *Page Sections* page template
2. Be a *top-level **Group** block* in the Content area

Anything you place *inside* the top-level Group block will use default styling with no adjustments, including nested Group blocks.

With this HTML structure and style system in place, you have the freedom to create custom theme templates using the style system or create the same in the block editor with the Page Sections template.

*NOTE: If using the Page Sections template, the top-level Group block can also take advantage of the `.inner` class modifiers to adjust the vertical padding.*

### Page Headers

The theme includes a page header template part that can be used in any template file. It is designed to display a more robust page header beneath the site header on various site pages.

Inside a standard template file, you may see the following code to display the site header and page header:

```php
get_header();
get_template_part( 'template-parts/section', 'page-header' );
```

This results in the following visual output at the top of this sample page:

![WordPress Starter Theme - Sample Page Screenshot](https://user-images.githubusercontent.com/2359131/232828083-56e2073f-e2be-48ce-b73f-9802e4919a76.png)

This is a dynamic page header that can be customized in several ways and across multiple templates. The `get_template_part()` call accepts arguments so that you can customize the title and description for each page. For example, the following code displays the post title and excerpt (if it exists) on a single blog post:

```php
get_template_part( 'template-parts/section', 'page-header', array(
	'title' => get_the_title(),
	'description' => has_excerpt() ? get_the_excerpt() : '',
) );
```

However, an archive page has slightly different needs:

```php
get_template_part( 'template-parts/section', 'page-header', array(
	'title' => get_the_archive_title(),
	'description' => get_the_archive_description(),
) );
```

How about the blog home template (home.php)? It should display the page title and excerpt, or perhaps a custom title and description from Advanced Custom Fields if they exist: 

```php
$title = get_the_title( get_option( 'page_for_posts' ) );
$description = get_the_excerpt( get_option( 'page_for_posts' ) );

if ( class_exists( 'acf' ) ) {

	if ( get_field( 'page_header_title', get_option( 'page_for_posts' ) ) ) {
		$title = get_field( 'page_header_title', get_option( 'page_for_posts' ) );
	}

	if ( get_field( 'page_header_description', get_option( 'page_for_posts' ) ) ) {
		$description = get_field( 'page_header_description', get_option( 'page_for_posts' ) );
	}
}

get_template_part( 'template-parts/section', 'page-header', array(
	'title' => $title,
	'description' => $description,
) );
```

The template part is used throughout the theme in a logical manner and is ready to be customized for any template file you decide to create.

### Customizer Options

The theme includes color scheme options in the Customizer. Set the body text, subdued body text, light background, dark background, and action colors to easily change the theme's general color scheme.

Once set in the Customizer, these colors are available for use in the Block Editor.

### Fat Footer

The theme includes a fat footer template part that can be used in any template file. It is designed to display a more robust footer at the bottom of the page, just above the footer copyright.

The area is separated into two columns. The left column is wide with a single widgetized area in it, meant for paragraph text and other relatively large elements. The right column is even wider, but broken down into three widgetized areas that display side by side, meant for more narrow elements like vertical navigation menus or social icons.

The fat footer only displays columns whose widget areas have widgets in them. If none of the areas have widgets in them, the entire fat footer will disappear.

Navigation menus placed in the fat footer will automatically be styled to display vertically and do not support submenus.

## Advanced Custom Fields

The aforementioned Page Header functionality is ready for use with [Advanced Custom Fields](https://advancedcustomfields.com/) (ACF) plugin. ACF can be used in any other way you'd like, but the theme includes a few custom fields that are ready to be used right out of the box. It works with both the [free](https://wordpress.org/plugins/advanced-custom-fields/) version and the pro version.

With either version of ACF activated, you can import the following `.json` file to create a new Field Group called **Page Settings** which includes a single Tab for **Page Header** and fields for `page_header_title` and `page_header_description`. These field values can then be used in the page header template part arguments to customize the page header title and description.

**[Download Page Settings JSON for ACF](assets/Page-Settings-ACF-Export.json)**

On site **pages** that are editable from the WordPress dashboard, you'll see a new **Page Settings** metabox. This metabox allows you to customize the page header title and description for any page. 

*Note: The Field Group is set to only display on WordPress pages, and only if the page *does not* use the Page Sections page template. If a page header is desired in the Page Sections template, it should be built in the block editor itself.*

## Theme Issues

If you encounter any issues with the theme, please [open an issue](https://github.com/SeanTOSCD/wordpress-starter-theme/issues). Please include as much information as possible, including:

- WordPress version
- PHP version
- Browser version
- Steps to reproduce the issue
- Screenshots
- Error messages
- Any other relevant information

## Screenshots

-----

### Page Sections - Page Template (all built inside the Block Editor)

![WordPress Starter Theme - Page Sections Screenshot](https://user-images.githubusercontent.com/2359131/232828087-9de98f8e-25ef-4708-92c0-0da56dcdc4a4.png)

### Blog Page

![WordPress Starter Theme - Blog Screenshot](https://user-images.githubusercontent.com/2359131/232828094-e0e1663b-686f-45b3-83f5-6dd2eba63ce0.png)

### Single Blog Post

![WordPress Starter Theme - Blog Post Screenshot](https://user-images.githubusercontent.com/2359131/232828096-0b8d3c0c-9432-4057-b75e-c4f8d1db0865.png)

### Page - Default Template

![WordPress Starter Theme - Sample Page Screenshot](https://user-images.githubusercontent.com/2359131/232828083-56e2073f-e2be-48ce-b73f-9802e4919a76.png)

### Page - Narrow Page Template

![WordPress Starter Theme - Sample Page Narrow Screenshot](https://user-images.githubusercontent.com/2359131/232828085-dd5b3657-42cb-47cd-9334-eda55b543f9e.png)

### Page - Wide Page Template

![WordPress Starter Theme - Sample Page Wide Screenshot](https://user-images.githubusercontent.com/2359131/232828079-decdc236-cbe5-4e42-8abb-08dbcf6bc2ed.png)

### Search

![WordPress Starter Theme - Search Screenshot](https://user-images.githubusercontent.com/2359131/232828076-a47ee730-2a72-4ad8-8d85-1a81fe860bdc.png)

### Mobile Navigation Menu

![WordPress Starter Theme - Mobile Menu Screenshot](https://user-images.githubusercontent.com/2359131/232828090-d123c7c0-36db-47ab-b858-972e07342bae.png)

### Customizer - Theme Colors

![WordPress Starter Theme - Customizer Theme Colors Screenshot](https://user-images.githubusercontent.com/2359131/232828091-75272213-bdd1-4ea6-a7bf-735b36a4c75d.png)
