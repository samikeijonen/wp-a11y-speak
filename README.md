# wp.a11y.speak demo

* [Check demo site how WordPress speaks](https://foxland.fi/demo/wordpress-speaks/).
* [Original reference article - how to use wp.a11y.speak() function](https://make.wordpress.org/accessibility/2015/04/15/let-wordpress-speak-new-in-wordpress-4-2/).

## Short introduction

In this demo there are three places where you can see code examples.

### functions.php

In `functions.php` file we enqueue our JS code and add strings used in `assets/scripts/filter-cities.js` file.

Note that we are adding `wp-a11y` as depency. It does all the magic.

```php
// Load filtering JS with wp-a11y JS.
wp_enqueue_script( 'wp-a11y-speak-filter', get_theme_file_uri( 'assets/scripts/filter-cities.js' ), array( 'wp-a11y' ), '20171008', true );

// Strings used in JS.
wp_localize_script( 'wp-a11y-speak-filter', 'WPA11ySpeakText', array(
	'restUrl'         => esc_url( rest_url( 'wp/v2/posts?per_page=50' ) ),
	'successMessage1' => esc_html__( 'Filtering contacts was successful.', 'wp-a11y-speak' ),
	'successMessage2' => esc_html__( 'Filtering categories was successful.', 'wp-a11y-speak' ),
) );
```

### assets/scripts/filter-cities.js

In `assets/scripts/filter-cities.js` file we have two examples:

1. Filter cities from pre-made array.
1. Filter posts by category using WordPress REST API.

In both examples main point is one line of code:

```js
wp.a11y.speak( WPA11ySpeakText.successMessage1, 'assertive' )
```

This will handle how result is announced also for screen readers. In this case **Filtering contacts was successful**.

### template-parts/content-page.php

In `[template-parts/content-page.php](blob/master/template-parts/content-page.php)` file there are forms that handle the logic in the front-end.
