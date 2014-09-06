<?php
/*/
Plugin Name: Pagination Plugin
Plugin URI: http://jagmit.co.uk
Description: Dynamic Pagination plugin (settings are within the plugin directory - config.php)
Version: 1.0
Author: Jagmit Gabba
Author URI: http://jagmit.co.uk
/*/

	require('config.php');

	//Pagination Element <[1]> of 10 pages
	if($paginationType == 0){
		if($totalPageNumber){
			function paginate() {
		    global $wp_query, $wp_rewrite;
		    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
		    $pagination = array(
		        'base' => @add_query_arg('page','%#%'),
		        'format' => '',
		        'total' => $wp_query->max_num_pages,
		        'current' => $current,
		        'show_all' => false,
		        'end_size' => 0,
		        'mid_size' => 0,
		        'type' => 'list'
		    );
		    if ( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
		    if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );  
				$pagination_args = array();
		    $links = paginate_links($pagination_args);
		    $links = "<div>$wp_query->max_num_pages</div>" . $links;
		    echo $links;
			}
		}
	}

if ( ! function_exists( 'jagmit_paging_nav' ) ) :

function jagmit_paging_nav() {
	global $paginationType, $prevnext, $typeOfArray, $middleSize, $totalPageNumber;

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	if($paginationType == 0){
	  $links = paginate_links( array(
      'base'     	=> $pagenum_link,
      'format'   	=> $format,
      'total'    	=> $GLOBALS['wp_query']->max_num_pages,
      'current'  	=> $paged,
      'mid_size' 	=> $middleSize,
      'add_args' 	=> array_map( 'urlencode', $query_args ),
      'type'     	=> $typeOfArray
	  ));
	}elseif($paginationType == 1 || $paginationType > 1 ){
		$links = paginate_links( array(
			'base'     	=> $pagenum_link,
			'format'   	=> $format,
			'total'    	=> $GLOBALS['wp_query']->max_num_pages,
			'current'  	=> $paged,
			'mid_size' 	=> $middleSize,
			'add_args' 	=> array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'yourtheme' ),
			'next_text' => __( 'Next &rarr;', 'yourtheme' ),
			'type'      => $typeOfArray
		));
	}

	if ( $links ) :

?>
	<?php if($paginationType == 0){ ?>
    <nav class="navigation paging-navigation" role="navigation">
      <ul class="page-numbers">
      	<?php if($prevnext){ ?>
					<li><div class="nav-next alignright"><?php previous_posts_link( 'Previous' ); ?></div><li>
				<?php } ?>
		    <li><div>Page:</div></li>
        <li> 
        	<select class="dynamic_select">
            <?php
            foreach ( $links as $pgl ) {
                if(strpos($pgl, 'class="prev') || strpos($pgl, 'class="next')){
                    continue;
                }
                $option = str_replace('<a','<option',$pgl);
                $option = str_replace('<span','<option id="current" selected ',$option);
                $option = str_replace('a>','option>',$option);
                $option = str_replace('span>','option>',$option);
                $option = str_replace('href','value',$option);
                $option = str_replace('current"','" id="current" selected',$option);

                echo $option;
            }
            ?>
	        </select>
	      </li>
        <li><div>of</div></li>
        <?php 
	        if($paginationType == 0){
						if($totalPageNumber){
							echo '<li>'.paginate().'</li>';
						}
					}
				?>
        <?php if($prevnext){ ?>
					<li><div class="nav-previous alignleft"><?php next_posts_link( 'Next' ); ?></div></li>
				<?php } ?>
      </ul>
    </nav>


	<?php } else if($paginationType == 1){ ?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'yourtheme' ); ?></h1>
			<?php echo $links; ?>
		</nav>
	<?php }else{ ?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'yourtheme' ); ?></h1>
			<?php echo $links; ?>
		</nav>


	<?php }
	endif;
}
endif;

?>