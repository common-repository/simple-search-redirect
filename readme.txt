=== Simple Search Redirect ===
Contributors: momnt
Tags: search, widget, shortcode, search engine, google, bing, yahoo, duckduckgo
Requires at least: 3.3.0
Tested up to: 3.5.1
Stable tag: 1.1.1
Donate Link: http://momnt.co/donate
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

A widget and shortcode that let you simply redirect users to various search engine's <code>site:</code> search filters, often more accurate than your default WordPress search functionality.



== Installation ==

1. Extract the zip file and upload the contents to the `wp-content/plugins/` directory of your WordPress installation, and then activate the plugin from plugins page.

2. Use the widget like any other, or use the `[simple-search-redirect]` shortcode along with the options explained below. 

= Shortcode Options =

`[simple-search-redirect]`, with no options passed, will default to Google's `site:` search. A "submit" button will appear, and no plugin credits will be displayed. These are the same defaults for the widget.

You can change the search engine with the `engine` shortcode attribute. The available engines are:
* Google (`google` in the shortcode)
* Bing (`bing` in the shortcode)
* Yahoo (`yahoo` in the shortcode)`
* Duck Duck Go (`duckduckgo` in the shortcode)

So, for example, this is how you can set the shortcocde to redirect to Yahoo:
`[simple-search-redirect engine=yahoo]`

You can disable the submit button with `button=false`, and enable plugin credits with `credits=true`.

Finally, the default `placeholder` text for the search input is "Search ...". You can change this with the `placeholder` shortcode attribute.

For example, changing the input placeholder to "Search on Google" is as easy as this:
`[simple-search-redirect engine=google placeholder="Search on Google"]`



== Frequently Asked Questions ==

= Does this redirect do anything on the server side of things? =

Nope, it's purely a JavaScript redirect. That does mean the search won't work if JavaScript is disabled, though this is something I'm trying to improve.

= Why doesn't my `placeholder` text show up? =

This is most likely because you're using a browser that doesn't support the HTML5 `placeholder` attribute for inputs.

= Why does the search input and/or submit button look weird? =

This plugin has zero custom CSS, so the styling of your input and submit button are entirely inhereted from the styles on your site. If something looks crappy, take a look at your theme's CSS to find what input styles you have, and write new ones if you need to.

= Why doesn't this work on my site? =

Hm, I'm not sure, let me know about your issue in the support forums and I'll take a look.



== Screenshots ==

1. Simple Search Redirect's simple widget interface, which lets you set up a search redirect. I'm not clever with plugin names.



== Upgrade Notice ==

= 1.0.0 =

* First version


== Changelog ==

= 1.0.0 =

* First version