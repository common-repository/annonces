=== Annonces ===
Contributors: Eoxia
Requires at least: 4.9.0
Tested up to: 4.9.6
Requires PHP: 5.6
Stable tag: 2.1.1
License: AGPLv3
License URI: https://spdx.org/licenses/AGPL-3.0-or-later.html

Annonces display announces posted in your WordPress interface on a Google map.

== Description ==

Annonces display announces posted in your WordPress interface on a Google map.

= Shortcodes =

Display the Google Map in a page with the shortcode :
`
[annonces]
`

= Filters =

= Change metadatas in infowindow of map =
`
add_filter('set_marker_data', 'mytheme_set_marker_data', 10, 2);
function mytheme_set_marker_data($microdata, $annonce_id) {
    // datas
    return $microdata;
}
`

= Change title of filter bloc over the map =

`
add_filter('bloc_filter_title', 'mytheme_set_filter_title', 10, 1);
function mytheme_set_filter_title($filter_title) {
    // datas
    return $filter_title;
}
`

= Template =

You can create single-announces.php in your child theme to edit the single page of announce : [code for the single-annouce.php](https://github.com/Eoxia/annonces/blob/master/modules/annonce/view/single-announce.php)

= ACF =

- Width the ACF plugin, you can create or import fields to personalize your announces.
- Edit the templates as explain above.
- You will obtain custom announces which will suit your project

== Installation ==
- In your backadmin, go to \"Plugins\" pannel
- Install the plugin Annonces
- Install required plugin : ACF Free and update it to version 5.x.x
- Activate plugins Annonces and ACF

== Screenshots ==
1. Map with announces
2. description of an announce

== Changelog ==

= 2.1.1 =

= Fix =

* 20891 - Fix activation error

= 2.1.0 =

= Fix =

* 20487 - Add condition ACF file existing or not to avoid errors
* 20488 - Review the name of the filters on the documentation
* 20489 - Add the Address field in the metadata (map & single)
* 20492 - add the ACF filter to set the Google map API Key
* XXXXX - Minor fix

= Improvment =

* 20498 - Improvement of the markers toggle script on the google map
* 20491 - Improved mobile display for the filter block
* 20564 - All modules in one menu page
* 20520 - Module Label
* 20563 - Module Author

= 2.0.0 =

= Improvment =

* 19873 - Core remastering functionalities
