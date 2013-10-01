<?php
/* Add a widget area after the content on any page or post, tested on twentyeleven */
/************************************************************************************/
/** Register After Post Widget Area.*/
function wpsites_after_post_widget() {
 
	 register_sidebar( array(
		'name' => 'After Post Widget',
		'id' => 'after-post',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'wpsites_after_post_widget' );
 
/** Filter & Hook In Widget After Post Content .*/
function after_post_widget($content) {
 
    if ( is_singular('post', 'page') && is_active_sidebar( 'after-post' ) ) {
       ob_start(); // Turn on output buffering
       dynamic_sidebar('after-post', array(
	        'before' => '<div class="after-post">',
            'after' => '</div>',
	        ) );
       
       $content .= ob_get_clean(); // Get current buffer contents and delete current output buffer
       return $content;
    }

}
add_filter( 'the_content', 'after_post_widget', 25 );
/**************************************************************************************************/
