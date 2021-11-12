<?php
// Author: erica dreisbach | @ericadreisbach



// 0. set up a constant to the template directory to avoid extra queries to DB
define('TDIR', get_bloginfo('stylesheet_directory'));




// 1. For debugging - output all scripts
function inspect_scripts() {
	if (!is_admin()) {
    global $wp_scripts;
    foreach( $wp_scripts->queue as $handle ) :
        echo $handle . ' | ';
    endforeach;
	}
}

// add_action( 'wp_print_scripts', 'inspect_scripts', 99 );



// 2. Conditionally remove unnecessary scripts
function deregister_javascript() {
		if (!is_admin()) {
		   wp_dequeue_script( 'conditionizr' );
		wp_deregister_script( 'conditionizr' );

       wp_dequeue_script( 'modernizr' );
    wp_deregister_script( 'modernizr' );

       wp_dequeue_script( 'html5blankscripts' );
    wp_deregister_script( 'html5blankscripts' );

		if (!is_single()) {
				wp_dequeue_script( 'msb-script' );
		 wp_deregister_script( 'msb-script' );
		}
	}
}
add_action('wp_enqueue_scripts', 'deregister_javascript', 100 );


// 2b. Remove jQuery migrate
function remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];

        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}
add_action('wp_default_scripts', 'remove_jquery_migrate');



// 3. For debugging - output all styles
/*
function inspect_styles() {
	if (!is_admin()) {
    global $wp_styles;
    foreach( $wp_styles->queue as $handle ) :
        echo $handle . ' | ';
    endforeach;
	}
}
add_action( 'wp_print_scripts', 'inspect_styles', 99 );
*/



// 4. Conditionally remove unnecessary styles
function deregister_css() {
 	   wp_dequeue_style( 'bodhi-svgs-attachment' );
  wp_deregister_style( 'bodhi-svgs-attachment' );

     wp_dequeue_style( 'wp-block-library' );
  wp_deregister_style( 'wp-block-library' );

     wp_dequeue_style( 'normalize' );
  wp_deregister_style( 'normalize' );

     wp_dequeue_style( 'html5blank' );
  wp_deregister_style( 'html5blank' );

	   wp_dequeue_style( 'msb-style' );
  wp_deregister_style( 'msb-style' );

}
add_action('wp_enqueue_scripts', 'deregister_css', 100 );



// 5. Style vsn
global $style_vsn;
$style_vsn = '1.1.09';



// 6. Header scripts (header.php)
//    - other scripts written in Vanilla Javascript injected in footer.php
//    - see js/scripts.min.js
//    - unminified in js/dev/scripts.js
function dbllc_header_scripts() {


	wp_register_script('jquery-core', '', 'jquery-core', '', false);
	wp_enqueue_script('jquery-core');

	if(is_single()) {
		wp_register_script('resources', TDIR . '/js/dev/resources.js', 'jquery-core', '1.0.1', false);
		 wp_enqueue_script('resources');
	}


	if(is_page('Our Work')) {
		wp_register_script('searchresults', TDIR . '/js/dev/load-search-results.js', 'jquery-core', '1.0.1', false);
		 wp_enqueue_script('searchresults');
	}


	if(is_archive() || is_search()) {
		wp_register_script('no-widows', TDIR . '/js/dev/no-widows.js', 'jquery-core', '1.0.2', false);
		 wp_enqueue_script('no-widows');
	}

}
add_action('wp_enqueue_scripts', 'dbllc_header_scripts', 10, 0);



// 7. Add defer to [plugin] scripts
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

function add_async_attribute($tag, $handle) {

	if ( ! is_admin() ) {
		if ( 'jquery-core' !== $handle ) {
			return str_replace( ' src', ' defer src', $tag );
		}
		elseif( 'jquery-core' == $handle ) {
			return str_replace( ' src', ' src', $tag );
		}
	}
	return $tag;
}



// 8. Remove emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');



// 9. Remove comment-reply.min.js from footer
function deregister_header(){
 wp_deregister_script( 'comment-reply' );
}
add_action('init','deregister_header');



// 10. Remove embed
function deregister_footer(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'deregister_footer' );



// 11. Add footer scripts
function footer_scripts() {
//  wp_register_script('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', 'jquery', '4.1.1');
  // wp_enqueue_script('bootstrap');
}
//add_action('wp_footer', 'footer_scripts');



// 12. Automatically update plugins
add_filter( 'auto_update_plugin', '__return_true' );



// 13. Remove type="text/javascript" and type="text/css"
add_filter('style_loader_tag', 'remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'remove_type_attr', 10, 2);

function remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}



// 14. Disable xml-rpc as this is commonly exploited to attack other sides
add_filter( 'xmlrpc_enabled', '__return_false' );



// 15. LOGIN


// 15a. Remove login message that confirms username in functions.php
//     src: https://ehikioya.com/forums/topic/how-to-change-or-remove-the-wordpress-login-error-message/
function remove_error_msg( $error ) {
    return '';
}
add_filter( 'login_errors', 'remove_error_msg' );


// 15b. Add reCAPTCHA to login
function load_custom_scripts() {

		if ( is_page_template ( 'page-login.php' ) ) {
			wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js', 'jquery-core', '2.0.0', 'all');
			wp_enqueue_script('recaptcha');

			wp_register_script('recaptcha-sitekey', get_stylesheet_directory_uri() . '/js/recaptcha-sitekey.js', 'jquery-core', '1.0.1', 'all');
			wp_enqueue_script('recaptcha-sitekey');
		}
}

if(!is_admin()) {
    add_action('wp_enqueue_scripts', 'load_custom_scripts', 99);
}


// 15c. Remove login message that confirms username in functions.php
// DEPRECATED!
// add_filter('login_errors', create_function('$a', "return null;"));


// 15d. Hide default login screen
//      src: https://wordpress.stackexchange.com/a/331091
add_action( 'init', 'dbllc_login_redirect');

function dbllc_login_redirect(){
	global $pagenow;
	if( 'wp-login.php' == $pagenow && $_GET['action']!="logout" && $_GET['action']!="lostpassword" && $_GET['action']!="rp") {
		wp_redirect( home_url( '/' ) );
	}
}


// 15e. Redirect home on logout
// add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
	wp_redirect( home_url( '/' ) );
	exit();
}


// 15f. Redirect to login page on failed login
add_action( 'wp_login_failed', 'darkblack_login_fail' );
function darkblack_login_fail( $username ) {
	$referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?

  // if there's a valid referrer, and it's not the default log-in screen
	if ( !empty($referrer) && !strstr($referrer,'wp-login') /*&& !strstr($referrer,'wp-admin')*/ ) {
			  // change admin-login to correct page as needed
				// append (login=failed) to the URL
        wp_redirect(home_url() . "/admin-login/" );
        exit;
	}
}


// 15g. Redirect to login page with blank username or password
add_filter( 'authenticate', 'darkblank_blank_username_password', 1, 3);

function darkblank_blank_username_password( $user, $username, $password ) {
	global $page_id;
	$login_page = home_url();
	$referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?

	// if there's a valid referrer, and it's not the default log-in screen
	if ( !empty($referrer) && !strstr($referrer,'wp-login') /* && !strstr($referrer,'wp-admin') */ ) {
		if( $username == "" || $password == "" ) {
			wp_redirect( $login_page . "/admin-login/" );
			exit;
		}
	}
}


// 15h. Disable the modal login screen on timeout
remove_action( 'admin_enqueue_scripts', 'wp_auth_check_load' );


// 15i. CUSTOMIZE WP-LOGIN - relevant to a different implementation
// Custom login screen for wp-login.php
function my_login_logo() { ?>
    <style type="text/css">
    #login h1 a, .login h1 a { background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg); height:65px; width:320px; background-size: contain; background-repeat: no-repeat; margin-bottom: 2em; }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
  return home_url();
}
// add_filter( 'login_headerurl', 'my_login_logo_url' );


// 15j. Exclude login page template from native search results
//      also exclude Kitchen Sink
//      src: https://stackoverflow.com/a/28983318
function exclude_page_templates_from_search($query) {

    global $wp_the_query;

		$excluded = array(
				'key' => '_wp_page_template',
				'value' => array('page-kitchensink.php', 'page-login.php'),
				'compare' => 'NOT IN',
		);

		$no_template = array(
			'key' => '_wp_page_template',
			'compare' => 'NOT EXISTS',
		);


    if ( ($wp_the_query === $query) && (is_search()) && ( ! is_admin()) ) {

        $meta_query =
            array(

                // set OR
                'relation' => 'OR',

                // remove pages with excluded templates from results
                $excluded,

                // show entries without a '_wp_page_template' key (posts)
                $no_template,
            );

        $query->set('meta_query', $meta_query);
    }
}
add_filter('pre_get_posts','exclude_page_templates_from_search');



// 16. Documentation
add_action('admin_menu', 'doc_menu');

function doc_fxn() {
	include('documentation.php');
}

function doc_menu() {
	add_menu_page( 'Documentation', 'Documentation', 'manage_options', 'documentation', 'doc_fxn', 'dashicons-book-alt', 3 );
}



// 17a. Output theme image sizes
//   useful when working with parents / children
//
//   call in template with
//   dbllc_get_additional_image_sizes();
function dbllc_get_additional_image_sizes() {
	global $_wp_additional_image_sizes;
	print '<pre>';
	print_r( $_wp_additional_image_sizes );
	print '</pre>';
}


function dbllc_remove_plugin_image_sizes() {
	remove_image_size('custom-size');
	remove_image_size('1536x1536');
	remove_image_size('2048x2048');
}
add_action('init', 'dbllc_remove_plugin_image_sizes');



// 17b. Thumbnails
function dbllc_setup() {
    add_theme_support('menus');               // Menu Support

    add_theme_support('post-thumbnails');

    // add_image_size('medium-retina', 1120, 600, true);    // Medium Thumbnail - resources default on retina screens
		// UPDATE large - 1120 x 600
		add_image_size('large', 1120, 600, false); // Large Thumbnail

		add_image_size('medium', 560, 300, false); // Medium Thumbnail

		add_image_size('small', 280, 280, true); // Small Thumbnail

		//add_image_size('medium-standard', 560, 300, false);  // Medium Thumbnail - resources default on standard screens
		// UPDATE medium - 560 x 300

		add_image_size('half', '50%', '50%', false);         // Half Size Image - useful for retina support

		// RSS enabled by parent theme
    load_theme_textdomain('dbllc', get_template_directory() . '/languages');
}
add_action( 'after_setup_theme', 'dbllc_setup', 100 );


// 17c. Remove medium_large image size
add_filter( 'intermediate_image_sizes', function( $sizes ) {
	return array_filter( $sizes, function( $val ) {
		return 'medium_large' !== $val; // Filter out 'medium_large'
	});
});



// 18. Inline scripts in footer
//  a. Accessible nav - subnavs appear on hover
//  b. Spamspan - protect email addresses from scrapers and spammers
function inline_scripts(){

	global $style_vsn;


	echo '<script>document.querySelectorAll(".menu-item-has-children [href]").forEach(e=>{var s=e.parentNode,a=e.parentNode.parentNode.parentNode;s.addEventListener("mouseover",e=>{s.classList.add("hover")}),s.addEventListener("mouseout",e=>{s.classList.remove("hover")}),e.addEventListener("focus",e=>{a.classList.contains("navbar-collapse")?s.classList.add("show"):a.classList.add("show")}),e.addEventListener("blur",e=>{a.classList.contains("navbar-collapse")?s.classList.remove("show"):a.classList.remove("show")})});</script>';


	echo '<script>var spamSpanMainClass="spamspan",spamSpanUserClass="u",spamSpanDomainClass="d",spamSpanAnchorTextClass="t",spamSpanParams=new Array("subject","body");function spamSpan(){for(var a=getElementsByClass(spamSpanMainClass,document,"span"),e=0;e<a.length;e++){for(var n=getSpanValue(spamSpanUserClass,a[e]),s=getSpanValue(spamSpanDomainClass,a[e]),t=getSpanValue(spamSpanAnchorTextClass,a[e]),p=new Array,r=0;r<spamSpanParams.length;r++){var l=getSpanValue(spamSpanParams[r],a[e]);l&&p.push(spamSpanParams[r]+"="+encodeURIComponent(l))}var m=String.fromCharCode(64),o=cleanSpan(n)+m+cleanSpan(s),d=document.createTextNode(t||o),c=String.fromCharCode(109,97,105,108,116,111,58)+o;c+=p.length?"?"+p.join("&"):"";var u=document.createElement("a");u.className=spamSpanMainClass,u.setAttribute("href",c),u.appendChild(d),a[e].parentNode.replaceChild(u,a[e])}}function getElementsByClass(a,e,n){var s=new Array;null==e&&(node=document),null==n&&(n="*");for(var t=e.getElementsByTagName(n),p=t.length,r=new RegExp("(^|s)"+a+"(s|$)"),l=0,m=0;l<p;l++)r.test(t[l].className)&&(s[m]=t[l],m++);return s}function getSpanValue(a,e){var n=getElementsByClass(a,e,"span");return!!n[0]&&n[0].firstChild.nodeValue}function cleanSpan(a){return a=(a=a.replace(/[\[\(\{]?[dD][oO0][tT][\}\)\]]?/g,".")).replace(/\s+/g,"")}function addEvent(a,e,n){a.addEventListener?a.addEventListener(e,n,!1):a.attachEvent&&(a["e"+e+n]=n,a[e+n]=function(){a["e"+e+n](window.event)},a.attachEvent("on"+e,a[e+n]))}addEvent(window,"load",spamSpan);</script>';
}
add_action( 'wp_footer', 'inline_scripts' );



// 19. Shortcode to output current year
//     enter [year]
function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');



// 20. Customizer
function remove_styles_sections($wp_customize) {
    // a. remove site icon and control via favicon.php instead
    $wp_customize->remove_control('site_icon');

    // b. remove custom CSS and its associated performance drag
    $wp_customize->remove_control('custom_css');
}
add_action( 'customize_register', 'remove_styles_sections', 20, 1 );



// 21. Options page for global elements powered by ACF
//     a. meta-description   (text area ~ 300 chars)
//     b. social-img         (img ~  1200px wide x 630px high)
//     c. social-txt         (text area ~ 300 chars)
if( function_exists('acf_add_options_page') ) {

 acf_add_options_page();

 /*acf_add_options_sub_page(array(
   'page_title' 	=> 'Meta / SEO',
   'menu_title' 	=> 'Meta / SEO'
 )); */
}

if (function_exists('acf_set_options_page_menu')){
	acf_set_options_page_menu('Open Graph + Footer');
}



// 22. MENUS
// 22a. Register menu locations
function register_menu() {
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'dbllc'),
				'offsite-menu' => __('Offsite Links Menu', 'dbllc'),
				'footer-menu-1' => __('Footer 1', 'dbllc'),
				'footer-menu-2' => __('Footer 2', 'dbllc'),
				'footer-menu-3' => __('Footer 3', 'dbllc'),
				'footer-menu-4' => __('Footer 4', 'dbllc'),
				'social-menu' => __('Social Media Menu', 'dbllc')
    ));
}
add_action( 'init', 'register_menu' );


// 22a. Deregister parent theme menu locations
function wpse_remove_parent_theme_locations()
{
    unregister_nav_menu( 'header-menu' );
		unregister_nav_menu( 'sidebar-menu' );
		unregister_nav_menu( 'extra-menu' );
}
add_action( 'init', 'wpse_remove_parent_theme_locations', 20 );



// 22b. Add more menus to array as necessary
function dbllc_nav($loc) {
	wp_nav_menu(
	array(
		//'theme_location'  => 'main-menu',
		'theme_location'  => $loc,
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'menu_class'      => 'menu',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
    'items_wrap'      => '<ul class="navbar-nav nav-' . $loc . '">%3$s</ul>',
		'depth'           => 0,   /* 0 means all levels of hierarchy */
		'after'						=> '<a class="open-submenu-a" href="#" tabindex="-1"></a>'/*,  remove mobile touch-to-open caret from tab order */
	));
}

// 22c. Bare nav (social)
function bare_nav($loc) {
	wp_nav_menu(
	array(
		//'theme_location'  => 'main-menu',
		'theme_location'  => $loc,
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'menu_class'      => 'menu',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
    'items_wrap'      => '<ul id="social" class="menu ' . $loc . '">%3$s</ul>',
		'depth'           => 0,   /* 0 means all levels of hierarchy */
	));
}



// 23. Hide editor on specific pages
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {

	// get id
	global $post;
	if ($post) { $post_id = $post->ID; }


  // for specific page ids
	/*
  if($post_id == '###' ) {
    remove_post_type_support('page', 'editor');
  }
  */


	// for specific custom post types
	//remove_post_type_support( 'resource', 'editor' );


	// for specific templates
	if($post) {
  	$template_file = get_post_meta($post_id, '_wp_page_template', true);

  	if($template_file == 'page-login.php'){
    	remove_post_type_support('page', 'editor');
  	}
	}

}



// 24. Sidebars / Widgets
if (function_exists('register_sidebar')) {
    // Define Footer Menus
    register_sidebar(array(
        'name' => __('Footer Menus', 'dbllc'),
        'description' => __('Add footer menus here', 'dbllc'),
        'id' => 'footer-menus',
        'before_widget' => '<div id="%1$s" class="col-footer">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer-h3">',
        'after_title' => '</h3>'
    ));

		register_sidebar(array(
				'name' => __('Copyright', 'dbllc'),
				'description' => __('Add copyright and other small-text footer information here. Add current year and copyright symbol with shortcode [copyright-year]', 'dbllc'),
				'id' => 'copyright',
				'before_widget' => '<div id="%1$s" class="col-xs-12">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="sr-only">',
				'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __('Support the Future of Funerals', 'dbllc'),
			'description' => __('Content that appears below Resource posts and on the homepage.'),
			'id' => 'support-the-future',
			'before_widget' => '<div class="container-fluid -support"><div class="container">',
			'after_widget' => '</div><!-- /.container --></div><!-- /.-support -->',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		));
}



// 25. Pagination for paged posts
function dbllc_pagination() {
    global $wp_query;
    $big = 999999999;
    /*
		echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
		*/

		$pagination = paginate_links(array(
				'base' => str_replace($big, '%#%', get_pagenum_link($big)),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $wp_query->max_num_pages
		));
		return $pagination;
}



// 26. Custom Posts per Page for Custom Post Type
// 26a. This function:
function custom_posts_per_page( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'CUSTOM' ) ) {
    $query->set( 'posts_per_page', '12' );
  }
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );


// 26b.   stucture wp_query like so
/*
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args = array(
	'orderby'   => 'date',
	'order' => 'DESC',
	'post_type' => 'CUSTOM',
	'paged' => $paged,
	'posts_per_page' => 12,
);

$wp_query = new WP_Query( $args ); ?>

<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
*/



// 27a. Remove <p> tags from Excerpt altogether
remove_filter('the_excerpt', 'wpautop');


// 27b. Custom excerpts
//      call with  _e(dbllc_excerpt());
function dbllc_excerpt() {
	global $post; $output = '';

	if($post->post_excerpt != '') {
		$output  = $post->post_excerpt;
		$output .= '&nbsp;&hellip;';
	}

	else {
		$output =  get_the_content($post->ID);

		// turn closing tags into spaces
		$output = str_replace("</h1>", "&nbsp;|&nbsp;", $output);
		$output = str_replace("</h2>", "&nbsp;", $output);
		$output = str_replace("</h3>", "&nbsp;", $output);
		$output = str_replace("</p>", "&nbsp;", $output);


		// strip out HTML tags and yield text
		// less robust
		$output = wp_strip_all_tags( $output );

		// slower
		// $output = wp_filter_nohtml_kses($output);
		// src: https://wordpress.stackexchange.com/a/163597


		// https://developer.wordpress.org/reference/functions/wptexturize/
		// turns " and ' into curly versions
		$output = apply_filters('wptexturize', $output);


		// https://developer.wordpress.org/reference/functions/convert_chars/
		// turns ampersands into &amp;
		$output = apply_filters('convert_chars', $output);
		$output = str_replace("&nbsp;", " ", $output);

		// get the first 15 words
		$output = implode(' ', array_slice(explode(' ', $output), 0, 15));

		if ($output != '') { $output = $output . '&nbsp;&hellip;'; }
	}

	return $output;

}

add_filter( 'excerpt_more', 'dbllc_excerpt', 999);



function dbllc_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'dbllc_excerpt_length', 999);




// 28. Current Year
// [copyright-year]
add_shortcode('copyright-year', function($atts, $content) {
    extract(shortcode_atts(array(
        'sign' => 'true',
    ), $atts));

		$start = '';
    $current_year = date('Y');
    $print_sign = ($sign === 'true') ? '&copy;' : '';

    if($start === $current_year || $start === '')
        return "{$print_sign} {$current_year}";
    else
        //return "<span class='nowrap'>{$print_sign} {$start}-{$current_year}</span>";
				return "<span class='nowrap'>{$print_sign}&nbsp;{$current_year}</span>";
});



// 29. Duplicate pages
// Dupes appear as drafts. User is redirected to the edit screen
// src: https://www.hostinger.com/tutorials/how-to-duplicate-wordpress-page-post

// 29a. function
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}

	// nonce verification
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;

	//get the original post id
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );

	//and all the original post data
	$post = get_post( $post_id );

	// if you don't want current user to be the new post author,
	// then change next couple of lines to this: $new_post_author = $post->post_author;
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;

	// if post data exists, create the post duplicate
	if (isset( $post ) && $post != null) {

		//new post data array
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		// insert the post by wp_insert_post() function
		$new_post_id = wp_insert_post( $args );

		// get all current post terms ad set them to the new post draft
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}

		// duplicate all post meta just in two SQL queries
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}


		// finally, redirect to the edit post screen for the new draft
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );


// 29b. Add the duplicate link to action list for post_row_actions
function rd_duplicate_page_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}

add_filter( 'page_row_actions', 'rd_duplicate_page_link', 10, 2 );


// 29c. Do the same for any post
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}

add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );



// 30. Remove HTML5 Blank defaults

// 30a. Remove HTML5 Blank Custom Post type
add_action( 'after_setup_theme', 'remove_html5blank_cpt' );
function remove_html5blank_cpt() {
    remove_action('init', 'create_post_type_html5');
}


// 30b. Remove page templates
//     src: https://wordpress.stackexchange.com/a/141654
function dbllc_remove_page_templates( $templates ) {
    unset( $templates['template-demo.php'] );
    return $templates;
}
add_filter( 'theme_page_templates', 'dbllc_remove_page_templates' );


// 30c. Remove Widget areas
//     src: https://wordpress.stackexchange.com/a/141654
function dbllc_remove_widgets(){
	unregister_sidebar( 'widget-area-1' );
	unregister_sidebar( 'widget-area-2' );
}
add_action( 'widgets_init', 'dbllc_remove_widgets', 11 );



// xx 31. Default timezone: Chicago
// date_default_timezone_set('America/Chicago');



// 32. Customizer
function dbllc_customize_register( $wp_customize ) {

		// 32a. custom svg logo
		$wp_customize->add_setting('logo_svg', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_svg', array(
			'label' => __( 'SVG (retina) Logo', 'dbllc' ),
			'section' => 'title_tagline',
			'settings' => 'logo_svg',
			'priority' => 1,
		)));



	  // 32b. png fallback logo
		$wp_customize->add_setting('logo_png_fallback', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => TDIR . '/img/logo.png',
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_png_fallback', array(
			'label' => __( 'Logo PNG Fallback', 'dbllc' ),
			'section' => 'title_tagline',
			'settings' => 'logo_png_fallback',
			'description' => __( 'For older browsers &amp; devices' ),
			'priority' => 8,
		)));


		// 32c. custom svg logo for mobile
		$wp_customize->add_setting('logo_svg_mobile', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_svg_mobile', array(
			'label' => __( 'Mobile SVG (retina) Logo for mobile', 'dbllc' ),
			'section' => 'title_tagline',
			'settings' => 'logo_svg_mobile',
			'priority' => 20,
		)));



		// 32d. png fallback logo for mobile
		$wp_customize->add_setting('logo_png_fallback_mobile', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => TDIR . '/img/logo.png',
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_png_fallback_mobile', array(
			'label' => __( 'Mobile Logo PNG Fallback', 'dbllc' ),
			'section' => 'title_tagline',
			'settings' => 'logo_png_fallback_mobile',
			'description' => __( 'For older browsers &amp; devices' ),
			'priority' => 21,
		)));

}
add_action( 'customize_register', 'dbllc_customize_register');



// 33. Add admin bar back for logged in users w/ Show Toolbar checked off
//     ... removed in HTML5 Blank parent theme
function addback_admin_bar() {

	// if user is logged in ...
	if( is_user_logged_in() ) {
		$user = wp_get_current_user();
		$user_id = $user->ID;
		$user_meta = get_user_meta($user_id);

		// check if user has checked off "Show Toolbar when viewing site"
		if ($user_meta['show_admin_bar_front']['0'] == 'true') {
    	return true;
		}
		// ... and if not, don't show toolbar
		else { return false; }
	}

	// users not logged in, don't show toolbar
	else { return false; }
}
add_filter('show_admin_bar', 'addback_admin_bar', 99);



// 34. Display Recent or Featured posts
//     EXAMPLE in Shortcode block
//    [ resources cat=13 ]
add_shortcode( 'resources', 'show_resources' );

function show_resources($attr, $content = null) {

	global $post; $content = $f_count = '';

	// get category id
	$shortcode_args = '';
	$shortcode_args = shortcode_atts(
		array(
			'cat' => '',
		),
	$attr);



	// 0. Row is empty if no resources in category
	$content  = '<div class="row">';


	// I. Get Featured
	//    get up to 2 posts in BOTH
	//    the shortcode ID category AND cat = 21 (Featured)
	$featured_args = array (
		'category__and' => array(21, $shortcode_args['cat']),
		'post_type' => 'post',
		'posts_per_page' => 2,
	);

	$f = new WP_Query($featured_args);
	$f_count = $f->found_posts;

	if ($f->have_posts()) {

		while ($f->have_posts()) {
			$f->the_post();

			$img_id = '';
			$retina_arr = '';
			$standard_arr = '';

			if(has_post_thumbnail()) {
				$img_id = get_post_thumbnail_id();

				$retina_arr = wp_get_attachment_image_src($img_id, 'large');
				$standard_arr = wp_get_attachment_image_src($img_id, 'medium');
				// [0] = url
				// [1] = width
				// [2] = height

				$img = wp_prepare_attachment_for_js($img_id);
				$img_alt = $img['alt'];
			}


			$terms = get_the_terms($f->ID, 'resource-type');
			$firstterm = $terms[0];
			$icon_alt = $firstterm->name;

			$default_svg = get_field('resource-icon-svg', $firstterm);
			$default_svg_url = $default_svg['url'];
			$default_png = get_field('resource-icon-png', $firstterm);
			$default_png_url = $default_png['url'];


			// get feat img id
			// wp_prepare_attachment_for_js($img_id);

			// if no feat img
			// get the resource type
			// get the SVG for that type
			// get the PNG for that type
			$content .= '<div class="col-md-6 col-article">';

			$content .= '<a class="resource-img-a';
			if ( has_post_thumbnail()) {
				$content .= ' -photo';
			}
			else {
				$content .= ' -icon';
			}
			$content .= '" href="' . get_the_permalink() . '">';
			// image
			if ( has_post_thumbnail()) {
			$content .= '<picture class="picture">';
			$content .= '<source type="image/jpg" srcset="' . $retina_arr[0] . ' 2x" media="(min-width: 992px)">';
			$content .= '<img class="img" src="' . $standard_arr[0] . '" alt="' . $img_alt . '" />';
			$content .= '</picture>';
			}
			// icon
			else {
			$content .= '<div class="icon-wrapper-div">';
			$content .= '<picture>';
			$content .= '<source type="image/svg+xml" srcset="' . $default_svg_url . '">';
			$content .= '<img src="' . $default_png_url . '" alt="' . $icon_alt . ' width="100" height="100" />';
			$content .= '</picture>';
			$content .= '</div>';
			}
			$content .= '</a>';

			$content .= '<a class="resource-article-a" href="';
			$content .= get_the_permalink();
			$content .= '" title="' . get_the_title() . '">';
			$content .= '<picture class="title-icon">';
			$content .= '<source type="image/svg+xml" srcset="' . $default_svg_url . '">';
			$content .= '<img class="icon-img" src="' . $default_png_url . '"  alt="' . $icon_alt . '" width="14" height="14" />';
			$content .= '</picture>';
			$content .= '&nbsp;<h2 class="article-h2">' . get_the_title() . '</h2> ';
			$content .= '</a>';
			$content .= '<p class="p">' . dbllc_excerpt() . '</p>';
			$content .= '</div><!-- /.col-md-6 -->';
		}
	}

	wp_reset_query(); wp_reset_postdata();



	// II. Other posts
	//     if there are fewer than 2 Featured posts in category
	if ($f_count < 2) {

		$p_args = array (
			'cat' => array($shortcode_args['cat'], -21),
			'post_type' => 'post',
			'posts_per_page' => (2 - $f_count),
		);

		$p = new WP_Query($p_args);

		if($p->have_posts()) {
			while ($p->have_posts()) {
				$p->the_post();

				$img_id = '';
				$retina_arr = '';
				$standard_arr = '';

				if(has_post_thumbnail()) {
					$img_id = get_post_thumbnail_id();

					  $retina_arr = wp_get_attachment_image_src($img_id, 'large');
					$standard_arr = wp_get_attachment_image_src($img_id, 'medium');
					// [0] = url
					// [1] = width
					// [2] = height

					$img = wp_prepare_attachment_for_js($img_id);
					$img_alt = $img['alt'];
				}

				$terms = get_the_terms($p->ID, 'resource-type');
				$firstterm = $terms[0];
				$icon_alt = $firstterm->name;

				$default_svg = get_field('resource-icon-svg', $firstterm);
				$default_svg_url = $default_svg['url'];
				$default_png = get_field('resource-icon-png', $firstterm);
				$default_png_url = $default_png['url'];


				// get feat img id
				// wp_prepare_attachment_for_js($img_id);

				// if no feat img
				// get the resource type
				// get the SVG for that type
				// get the PNG for that type
				$content .= '<div class="col-md-6 col-article">';

				$content .= '<a class="resource-img-a';
				if ( has_post_thumbnail()) {
					$content .= ' -photo';
				}
				else {
					$content .= ' -icon';
				}
				$content .= '" href="' . get_the_permalink() . '">';

				// image
				if ( has_post_thumbnail()) {
					$content .= '<picture class="picture">';
					$content .= '<source type="image/jpg" srcset="' . $retina_arr[0] . '.webp 2x" media="(min-width: 767px)">'; /* retina webp   */
				  $content .= '<source type="image/jpg" srcset="' . $retina_arr[0] . ' 2x" media="(min-width: 767px)">';      /* retina jpg    */
					$content .= '<source type="image/jpg" srcset="' . $standard_arr[0] . '.webp">';                             /* standard webp */
					$content .= '<img width="560" height="300" class="img" src="' . $standard_arr[0] . '" alt="' . $img_alt . '" />';
					$content .= '</picture>';
				}
				// icon
				else {
					$content .= '<div class="icon-wrapper-div">';
					$content .= '<picture>';
					$content .= '<source type="image/svg+xml" srcset="' . $default_svg_url . '">';
					$content .= '<img src="' . $default_png_url . '" alt="' . $icon_alt . ' width="100" height="100" />';
					$content .= '</picture>';
					$content .= '</div>';
				}

				$content .= '</a>';

				$content .= '<a class="resource-article-a" href="';
				$content .= get_the_permalink();
				$content .= '" title="' . get_the_title() . '">';
				$content .= '<picture class="title-icon">';
				$content .= '<source type="image/svg+xml" srcset="' . $default_svg_url . '">';
				$content .= '<img class="icon-img" src="' . $default_png_url . '"  alt="' . $icon_alt . '" width="14" height="14" />';
				$content .= '</picture>';
				$content .= '&nbsp;<h2 class="article-h2">' . get_the_title() . '</h2> ';
				$content .= '</a>';
				$content .= '<p class="p">' . dbllc_excerpt() . '</p>';
				$content .= '</div><!-- /.col-md-6 -->';
			}
		}
	}


	$content .= '</div><!-- / close the row -->';


  return $content;


	wp_reset_query(); wp_reset_postdata();

}



// 35. Events
add_shortcode( 'events', 'show_events' );

function show_events( $events = null ) {

	global $post;

	$tmw_dt = new DateTime('tomorrow', new DateTimeZone('UTC + 5'));
	$tmw    = $tmw_dt->format('Ymd');
	$tmw    = intval($tmw);


	$args = array (
		'post_type' => 'events',
		'posts_per_page' => 2,

		'meta_key' => 'event-start-date',
		'order_by' => 'meta_value',
		'order' => 'ASC',

		'meta_query' => array(

			'relation' => 'OR',

			array(
				'key' => 'event-start-date',
				'value' => $tmw,
				'compare' => '>'
			),

			array(
				'key' => 'event-end-date',
				'value' => $tmw,
				'compare' => '>'
			)
		)

	);

	$events = '';

	$p = new WP_Query( $args );

	if ($p->have_posts()) {
		$events  = '<div class="row">';

		while($p->have_posts()) {
			$p->the_post();

			$events .= '<div class="event-col col-md-6">';

			if(get_field('event-end-date')) {
				$display_date = '';

				// get start
				$start = get_field('event-start-date');
				$start = strtotime($start);
				$start_d = date('j', $start);
				$start_m = date('M', $start);
				$start_y = date('Y', $start);

				$end = get_field('event-end-date');
				$end = strtotime($end);
				$end_d = date('j', $end);
				$end_m = date('M', $end);
				$end_y = date('Y', $end);

				// different years
				if ($start_y !== $end_y) {
					$display_date = $start_m . ' ' . $start_d . ', ' . $start_y . ' &ndash; ' . $end_m . ' ' . $end_d . ', ' . $end_y;
				}
				// different months
				elseif ($start_m !== $end_m) {
					$display_date = $start_m . ' ' . $start_d . ' &ndash; ' . $end_m . ' ' . $end_d . ', ' . $start_y;
				}

				// same month + year
				else {
					$display_date = $start_m . ' ' . $start_d . ' &ndash; '. $end_d . ', ' . $start_y;
				}

				$events .= '<span class="date">' . $display_date . '</span> <br />';

			}

			else {
				$date = get_field('event-start-date');

				// convert to unix timestamp
				$date = strtotime($date);

				$date = date("M j, Y", $date);
				$events .= '<span class="calendar"></span> <span class="date">' . $date . '</span> <br />';
			}


			$events .= get_the_title() . ' <br />';
			if (get_field('event-location')) {
				$events .= get_field('event-location') . ' <br />';
			}
			$events .= '<a href="' . get_the_permalink() . '">Learn more</a>';
			$events .= '</div><!-- /.col-sm-6 -->';
		}

		$events .= '</div><!-- /.row -->';
	}

	wp_reset_postdata();

	return $events;
}



// 36. Hide Comments Column on admin side (not used)
add_filter("manage_posts_columns", "hide_columns_in_admin");

function hide_columns_in_admin($columns){
  unset($columns['comments']);
  return $columns;
}


// 37. Shortcode for Support the Future
add_shortcode( 'supportthefuture', 'supportthefuture', 99);
function supportthefuture(){
    dynamic_sidebar('support-the-future');
}


// 38. Shortcode for Search Form
add_shortcode( 'advancedsearch', 'searchform');
function searchform() {
	return get_search_form(false);
}


// 39. Write custom CSS to Stripe iframe
function stripe_custom_css() {

	$path = $_SERVER['DOCUMENT_ROOT'];

	if ($path == '/Library/WebServer/Documents') { $path = '/Library/WebServer/Documents/world'; }
	else                                         { $path = $path . '/snmrzntpnq'; }

	$stripe_css_mods = file_get_contents( $path . '/files/themes/world-theme/css/pp-combined.min.css');

	$stripe_css_loc = $path . '/files/plugins/stripe-payments/public/views/templates/default/pp-combined.min.css';

	$stripe_css = fopen($stripe_css_loc, 'w') or die('Unable to open file!');

	fwrite($stripe_css, $stripe_css_mods);
	fclose($stripe_css);
}

add_action('wp_footer', 'stripe_custom_css', 99);



// 40. Search Results shortcode
add_shortcode( 'searchresults', 'searchresultsdiv');
function searchresultsdiv() {

	// set new wp_query for all post_type = "post"
	global $wp_query;

	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

	$posts_per_page = get_option( 'posts_per_page' );

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged
	);

	// use global variable $wp_query
	// not, like, $loop or $news or whatever
	$wp_query = new WP_Query( $args );

	   $count = $wp_query->found_posts;

	$results  = '<div id="search-results">';

	// by default, show ALL resources with paging
	if ( $wp_query->have_posts() ) {


		$results .= '<div class="container"><h2 class="search-results-h1">Browse All ' . $count . ' Resources</a></div>';


		while ( $wp_query->have_posts() ) : $wp_query->the_post();


			$terms = $firstterm = '';
			$terms = get_the_terms(get_the_ID(), 'resource-type');

			if ($terms != '') {

				$firstterm = $terms[0];

				$icon_alt = $firstterm->name;

				$default_svg = get_field('resource-icon-svg', $firstterm);
				$default_svg_url = $default_svg['url'];
				$default_png = get_field('resource-icon-png', $firstterm);
				$default_png_url = $default_png['url'];
			}


			$classes = ''; $classes_arr = get_post_class();

			$i = 0; $count = count($classes_arr);

			foreach ($classes_arr as $classes_ar) {
				$classes .= $classes_ar;
				if ($i < $count ) { $classes .= ' '; }
				$i++;
			}


			$results .= '<article id="post-' . get_the_id() . '"  class="' . $classes . '">';

			$results .= '<a class="archive-a" href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
			$results .= '<div class="container">';


			$results .= '<div class="archive-img">';

			if(has_post_thumbnail()) {
				$img_id = get_post_thumbnail_id();
				$standard_arr = wp_get_attachment_image_src($img_id, 'medium');
								 $img = wp_prepare_attachment_for_js($img_id);
						 $img_alt = $img['alt'];

				$results .= '<picture class="-photo picture"><source type="image/webp" srcset="' . $standard_arr[0] . '.webp" /><img width="280" height="150" class="img" src="' . $standard_arr[0] . '" alt="' . $img_alt . '" /></picture>';
			}

			elseif ($terms != '') {
				$results .= '<div class="default-archive-img">';
				$results .= '<picture class="-icon picture">';
				$results .= '<source type="image/svg+xml" srcset="' . $default_svg_url . '">';
				$results .= '<img width="100" height="100" src="' . $default_png_url . '" alt="' . $icon_alt . '" />';
				$results .= '</picture>';
				$results .= '</div>';
			}

			$results .= '</div><!-- /.archive-img -->';

			$results .= '<div class="archive-txt">';
			$results .= '<div class="archive-title-excerpt">';
			if ($terms != '') {
				$results .= '<h2 class="archive-h2" id="archive-h2">' . get_the_title() . '</h2> ';
				$results .= '<div class="picture-div"><picture class="icon archive-icon"><source type="image/svg+xml" srcset="' . $default_svg_url . '" /><img class="icon-img" src="' . $default_png_url . '"  alt="' . $icon_alt . '" width="14" height="14" /></picture></div>';
			}
			else {
				$results .= '<h2>' . get_the_title() . '</h1>';
			}

			$results .= '<p class="archive-p">' . dbllc_excerpt() . '</p>';
			$results .= '</div><!-- /.archive-title-excerpt -->';

			$results .= '<div class="archive-meta"><div class="resource-meta">';
			$results .= '<div class="meta-time">';
			$results .= '<h2 class="meta-h2">PUBLISHED: </h2> ' .  get_the_time("F j, Y");
			$results .= '</div><!-- /.meta-time -->';

			if($firstterm != '' && $firstterm->slug == 'white-paper') {
				$results .= '<div class="meta-author">';
				$results .= '<h2 class="meta-h2">AUTHOR:</h2> ';
				$results .=  get_the_author();
				$results .= '</div><!-- /.meta-author -->';
			}
			elseif($firstterm != '' && $firstterm->slug == 'video') {
				$results .= '<div class="meta-author">';
				$results .= '<h2 class="meta-h2">POSTED BY:</h2> ';
				$results .=  get_the_author();
				$results .= '</div><!-- /.meta-author -->';
			}

			$results .= '</div><!-- /.resource-meta --></div><!-- /.archive-meta -->';

			$results .= '</div><!-- /.archive-txt -->';

			$results .= '</div><!-- /.container -->';
			$results .= '</a>';
			$results .= '</article>';

		endwhile;

	}


	$results .= '<div id="pagination" class="pagination -archive">';
	$results .= dbllc_pagination();
	$results .= '</div><!-- /#pagination.pagination.-archive -->';


	wp_reset_query();


	$results .= '</div><!-- /#search-results -->';
	return $results;
}
