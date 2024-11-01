<?php 
/**
 *  The basic Simple Search Redirect shortcode
 *
 *  This shortcode will give users a search box that redirects their query to the selected search engine, with the site:{user's site url} filter applied, just like the widget will.
 *
 *  @since Simple Search Redirect 1.0.0
 */
class Simple_Search_Redirect_Shortcode {



    /**
     *  the actual [simple-search-redirect] shortcode
     *  @since Simple Search Redirect 1.0.0
     */
    function shortcode($atts) {

        extract(shortcode_atts(array(
            'engine'      => 'google',
            'placeholder' => __('Search ...', 'simple-search-redirect'),
            'button'      => true,
            'credits'     => false
        ), $atts));


        // clean site url
        $messy_url = get_site_url();
        $clean_url = $this->remove_protocols_from($messy_url);

        $button_output = '';

        if( $button == 'true')
            $button_output = '<input type="submit" value="'. __('Search','simple-search-redirect') .'">';

        ob_start();

        switch($engine) {

            case 'google' : ?>
                <form onsubmit="location.href='//www.google.com/search?q=' + document.getElementById('simple-search-redirect-google').value + '+site%3A<?php echo $clean_url; ?>'; return false;">
                    <input type="text" id="simple-search-redirect-google" placeholder="<?php echo esc_attr($placeholder); ?>" class="widefat">
                    <?php echo $button_output; ?>
                </form>
            <?php break; 

            case 'duckduckgo' : ?>
                <form onsubmit="location.href='//www.duckduckgo.com/?q=' + document.getElementById('simple-search-redirect-duckduckgo').value + '+site%3A<?php echo $clean_url; ?>'; return false;">
                    <input type="text" id="simple-search-redirect-duckduckgo" placeholder="<?php echo esc_attr($placeholder); ?>">
                    <?php echo $button_output; ?>
                </form>
            <?php break;

            case 'bing' : ?>
                <form onsubmit="location.href='//www.bing.com/search?q=' + document.getElementById('simple-search-redirect-bing').value + '+%20site%3A<?php echo $clean_url; ?>'; return false;">
                    <input type="text" id="simple-search-redirect-bing" placeholder="<?php echo esc_attr($placeholder); ?>">
                    <?php echo $button_output; ?>
                </form>
            <?php break;

            case 'yahoo' : ?>
                <form onsubmit="location.href='//search.yahoo.com/search?p=' + document.getElementById('simple-search-redirect-yahoo').value + '+site%3A<?php echo $clean_url; ?>'; return false;">
                    <input type="text" id="simple-search-redirect-yahoo" placeholder="<?php echo esc_attr($placeholder); ?>">
                    <?php echo $button_output; ?>
                </form>
            <?php break;
        }

        if( $credits == 'true')
            _e('<p>Powered by <a href="//wordpress.org/extend/plugins/simple-search-redirect">Simple Search Redirect</a></p>');

        $search_form = ob_get_contents();
        ob_end_clean();

        return $search_form;

    }

    /**
     *  remove http:// and https:// from url so our filter can work
     *  thank you jakob relkin! http://stackoverflow.com/users/220819/jacob-relkin
     *  @since Simple Search Redirect 1.0.0
     */
    function remove_protocols_from($url) {

        $protocols = array('http://', 'https://');

        foreach($protocols as $protocol) :
            
            if(strpos($url, $protocol) === 0)
                return str_replace($protocol, '', $url);

        endforeach;

        return $url;
    }



    /**
     *  let's get goin', chief
     *  @since Simple Search Redirect 1.0.0
     */
    function __construct() {
        add_shortcode( 'simple-search-redirect', array($this, 'shortcode'));
    }



} ?>