=== Plugin Name ===
Contributors: seobiz
Donate link: http://www.djmakebiz.com
Tags: widget, favorite, post, anounce
Requires at least: 2.0.2
Tested up to: 2.8
Stable tag: 1.0

Plugin adds a widget that allows to display anounces of posts
in a blocks in the sidebar. Supports thumbnails, custom fields, your own styles.

== Description ==

Plugin adds a widget that allows to display anounces of selected posts in a special blocks in the sidebar. Supports the display of thumbnails, custom fields, your own styles. Styles may be configured through a separate CSS file.

Widget option:

- Category ID (the desired category ID)
- Number of anounces (number of displaying anounces)
- Number of chars (number of chars in one anounce)
- With custom field (only for anounces with custom fields)
- Special style
- Show category (displaying or not the name of category)
- Show thumbnail

To insert thumbnail in a block with the announcement, 
just add the appropriate post field 'favpostimg' (lowercase, without quotes) 
and set full path (URL) to image.

If you want display only favorites posts that you want, 
then add in the appropriate post any custom field with any value
(value of custom field must be not empty) and set this field in widget options. 
In this case categories do not matter.

Add to sidebar so many widgets as you like and displaying through each 
widget only selected posts with appropriate custom fields.

If nothing set in widget options, then default settings is category 1, 
number of anounces 3, number of chars in each anounce 300.

For make your own style of special anounces blocks use css file '/favposts/favposts.css'.

List of css classes that you can change:

cat-design - style displaying of category
cat-nodesign - displaying category without special style
fav-title - style titles of posts
favblok-design - style displaying of anounce
favblok-nodesign - style displaying without special style
favimg - style displaying thumbnails in anounces

== Installation ==

1. Upload whole directory `favposts` to the `/wp-content/plugins/` directory.
2. Activate the plugin 'Favorites Posts' through the 'Plugins' menu in WordPress.
3. Add the widget 'Favorites Posts' to your sidebar from Appearance->Widgets and configure the widget options.

== Frequently Asked Questions ==

= Why thumbnail not displaying in anounces? =

May be not correct custom field or not correct path (URL) to image. Check it.

== Screenshots ==

1. screenshot-1.jpg
2. screenshot-2.jpg

== Changelog ==

= 1.0 =
* First version.




