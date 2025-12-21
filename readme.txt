Web Design Feed 

Author: Timothy Blake

Overview:
A compact, accessible starter theme tailored for a design/news blog. Includes template parts, a posts loop, sidebar helpers, related posts, a newsletter shortcode, and several custom image sizes.

Installation:
1. Copy the `webDesign-feed-one_stop_shop` (or the theme folder) into your WordPress `wp-content/themes/` directory.
2. Activate the theme in WordPress admin → Appearance → Themes.
3. (Optional) Assign a menu to the "Primary Menu" location in Appearance → Menus and add widgets to the Sidebar areas.

Quick features:
- Template parts: `template-parts/loop.php`, `featured-loop.php`, `related-posts.php`, `site-header.php`, and `sidebar-menu.php`.
- Alternate single post templates: `single.php`, `single-blog.php`, `single-layout-two.php`.
- Sidebar widgets: `sidebar-1` and `sidebar-2` registered.
- Custom image sizes: featured_xs, featured_small, featured_medium, featured_large, featured_hero.
- Helper: `web_design_feed_get_link_by_class()` finds the first <a> with a configured button class (default: `btn-primary`) in post content; falls back to `source_link` post meta.
- Post meta: `source_link` meta box added to the post editor to explicitly set a source URL.
- Newsletter shortcode: `[wdf_newsletter]` — renders a sign-up form and enqueues Google reCAPTCHA.
- Accessible social icons using theme SVG assets and favicons/manifest included.

Templates & How to use:
- `index.php` and `category.php` use `template-parts/loop.php` to output posts.
- `template-parts/loop.php` will attempt to link titles/thumbnails/buttons to a source URL found in the post content (anchor with class configured in the Customizer) or the `source_link` custom field. If none found it falls back to the post permalink.
- To change which anchor class is detected (e.g. `btn-primary` or `button-primary`), go to Appearance → Customize → Web Design Feed and update "Default button link class".
- Apply `single-blog.php` or `single-layout-two.php` per-post from the Post Editor (Template dropdown) to use alternate single layouts.

Image sizes (registered):
- featured_xs (100×100)
- featured_small (145×140)
- featured_medium (300×200)
- featured_large (1024×512)
- featured_hero (1600×600)

Developer notes:
- After adding image sizes, regenerate thumbnails for existing media. Recommended WP-CLI command:
  wp media regenerate --yes
  or use a plugin like "Regenerate Thumbnails" from the WP plugin directory.
- The newsletter shortcode enqueues client-side Google reCAPTCHA only — server-side token verification should be implemented by your external endpoint or added to WordPress if you proxy submissions.
- A Customizer setting controls the default anchor class used by the link-extraction helper; a meta box on the post editor allows per-post override via `source_link`.

Testing checklist:
- Create posts with an <a class="btn-primary" href="https://example.com"> link to verify loop links point to that URL and external links open in a new tab with rel="noopener noreferrer".
- Create posts without such a link to ensure the loop falls back to the post permalink.
- Add a `source_link` meta (in the post editor side panel) to test overrides.
- Verify pagination, related posts, and sidebar widgets appear as expected.

Credits & License:
- Theme scaffolded and maintained by Timothy Blake.
- Includes placeholder SVG and favicon assets; replace with your own assets as needed.
- License: Please refer to LICENSE file included in the theme.

Support / Contact:
- For help customizing the theme further, contact the author or open an issue in your project tracker.
