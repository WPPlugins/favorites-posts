<?php
/*
Plugin Name: Favorites Posts
Plugin URI: http://www.djmakebiz.com/?p=698
Description: Plugin adds a widget that allows to display anounces of selected posts in a special blocks in the sidebar. Supports the display of thumbnails, custom fields and your own styles.
Author: seobiz
Version: 1.0
Author URI: http://www.djmakebiz.com/
*/
?>

<?php
add_action('wp_print_styles', 'favposts_stylesheets');
function favposts_stylesheets() {
wp_enqueue_style('favposts', plugins_url('favposts/favposts.css'), false, '1.0', 'all');
		
} 
?>


<?php

class FavoritesPosts extends WP_Widget {
function FavoritesPosts() {
parent::WP_Widget(false, $name = 'Favorites Posts');
}


function widget($args, $instance) {
extract( $args );
?>
<?php echo $before_title 
. $instance['title']
. $after_title;
$shfav = $instance['shfav'];
$numposts = $instance['numposts'];
$numchars = $instance['numchars'];
$favfield = $instance['favfield'];
$fav = $instance['fav'] ? '1' : '0';
$mini = $instance['mini'] ? '1' : '0';
$design = $instance['design'] ? '1' : '0';
$showcat = $instance['showcat'] ? '1' : '0';
if ( !$shfav = (int) $instance['shfav'] ) {$shfav=1;}
if ( !$numposts = (int) $instance['numposts'] ) {$numposts=3;}
if ( !$numchars = (int) $instance['numchars'] ) {$numchars=300;}

global $post; 
             ?>

<?php //--------------------------------- ?>


<?php //-------------------------------- ?>

<?php

if ($fav!=false and strlen($favfield)<>0) {
global $customFields;
$customFields = "'".$favfield."'";
$customPosts = new WP_Query();
add_filter('posts_join', 'get_custom_field_posts_join');
add_filter('posts_groupby', 'get_custom_field_posts_group');
$customPosts->query('showposts=5' );
remove_filter('posts_join', 'get_custom_field_posts_join');
remove_filter('posts_groupby', 'get_custom_field_posts_group');
while ($customPosts->have_posts()) : $customPosts->the_post(); ?>

<?php if ($showcat!=false) { ?>

 <span class="<?php if ($design!=false) {echo "cat-design";} else {echo "cat-nodesign";} ?>"><a href="<?php echo get_category_link("$shfav");?>" title="Посмотреть все записи в этой рубрике"><?php echo get_the_category_by_ID($shfav) ?></a></span> <?php } ?>

<div class="<?php if ($design!=false) {echo "favblok-design";} else {echo "favblok-nodesign";} ?>">


<h3 class="fav-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title2(); ?></a></h3>


<?php if( get_post_meta($post->ID, "favpostimg", true) and $mini!=false):  ?>
<a href="<?php the_permalink() ?>" rel="bookmark"><img style="float:left; margin:4px 10px 0px 0px; padding:1px; border:1px solid #a2a2a2;" src="<?php  echo get_post_meta($post->ID, "favpostimg", true); ?>" alt="<?php the_title();  ?>" /></a> 

<?php endif; ?>

		
      <?php the_content_limit($numchars, ""); ?>
</div>
 		
<?php endwhile;    ?>  <?php } ?>


<?php //---------------------------------- ?>




<?php //--------------------------------- ?>


<?php if ($fav!=true) { ?>


<?php $my_query = new WP_Query("cat=$shfav&showposts=$numposts"); 
         while ($my_query->have_posts()) : $my_query->the_post(); ?>

<?php if ($showcat!=false) { ?>
<span class="<?php if ($design!=false) {echo "cat-design";} else {echo "cat-nodesign";} ?>"><a href="<?php echo get_category_link("$shfav");?>" title="Посмотреть все записи в этой рубрике"><?php echo get_the_category_by_ID($shfav) ?></a></span> <?php } ?>

<div class="<?php if ($design!=false) {echo "favblok-design";} else {echo "favblok-nodesign";} ?>">

<h3 class="fav-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title2(); ?></a></h3>


<?php if( get_post_meta($post->ID, "favpostimg", true) and $mini!=false):  ?>
<a href="<?php the_permalink() ?>" rel="bookmark"><img class="favimg" src="<?php  echo get_post_meta($post->ID, "favpostimg", true); ?>" alt="<?php the_title();  ?>" /></a> 

<?php endif; ?>

		
      <?php the_content_limit($numchars, ""); ?>
</div>
 		
<?php endwhile;    ?>  <?php } ?>

<?php //-------------------------------------- ?>



<?php //--------------------------------- ?>





<?php //-----------------   ?>

<?php
}


function update($new_instance, $old_instance) {
return $new_instance;
}

function form($instance) {
$title = esc_attr($instance['title']);
$shfav = esc_attr($instance['shfav']);
$numposts = esc_attr($instance['numposts']);
$numchars = esc_attr($instance['numchars']);
$favfield = esc_attr($instance['favfield']);
$fav = isset($instance['fav']) ? (bool) $instance['fav'] :false;
$mini = isset($instance['mini']) ? (bool) $instance['mini'] :false;
$design = isset($instance['design']) ? (bool) $instance['design'] :false;
$showcat = isset($instance['showcat']) ? (bool) $instance['showcat'] :false;

?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</label>
</p>

<p>
<label for="Category ID:">Category ID:
<input style="width: 30px;" id="<?php echo $this->get_field_id('shfav'); ?>" name="<?php echo $this->get_field_name('shfav'); ?>" type="text" value="<?php echo $shfav; ?>" />
</label>
</p>

<p>
<label for="Number of anounces:">Number of anounces:
<input style="width: 30px;" id="<?php echo $this->get_field_id('numposts'); ?>" name="<?php echo $this->get_field_name('numposts'); ?>" type="text" value="<?php echo $numposts; ?>" />
</label>
</p>

<p>
<label for="Number of chars:">Number of chars:
<input style="width: 35px;" id="<?php echo $this->get_field_id('numchars'); ?>" name="<?php echo $this->get_field_name('numchars'); ?>" type="text" value="<?php echo $numchars; ?>" />
</label>
</p>

<p>
<input type="checkbox" id="<?php echo $this->get_field_id('fav'); ?>" name="<?php echo $this->get_field_name('fav'); ?>"<?php checked( $fav ); ?> />
             <label for="<?php echo $this->get_field_id('fav'); ?>"><?php _e( 'Custom field:' ); ?></label><input style="width: 80px;" id="<?php echo $this->get_field_id('favfield'); ?>" name="<?php echo $this->get_field_name('favfield'); ?>" type="text" value="<?php echo $favfield; ?>" />
</p>

<p>
<input type="checkbox" id="<?php echo $this->get_field_id('showcat'); ?>" name="<?php echo $this->get_field_name('showcat'); ?>"<?php checked( $showcat ); ?> />
             <label for="<?php echo $this->get_field_id('showcat'); ?>"><?php _e( 'Show category' ); ?></label>
</p>



<p>
<input type="checkbox" id="<?php echo $this->get_field_id('mini'); ?>" name="<?php echo $this->get_field_name('mini'); ?>"<?php checked( $mini ); ?> />
             <label for="<?php echo $this->get_field_id('mini'); ?>"><?php _e( 'Show thumbnail' ); ?></label>
</p>

<p>
<input type="checkbox" id="<?php echo $this->get_field_id('design'); ?>" name="<?php echo $this->get_field_name('design'); ?>"<?php checked( $design ); ?> />
             <label for="<?php echo $this->get_field_id('design'); ?>"><?php _e( 'Special style' ); ?></label>
</p>


<?php
}

  }
  
  
function the_title2($before = '', $after = '', $echo = true, $length = false) {
         $title = get_the_title();

      if ( $length && is_numeric($length) ) {

             $title = substr( $title, 0, $length );

          }

        if ( strlen($title)> 0 ) {

             $title = apply_filters('the_title2', $before . $title . $after, $before, $after);

             if ( $echo )

                echo $title;

             else

                return $title;

          }

      }  
  

function the_content_limit($max_char, $more_link_text = '(Читать полностью &rarr;)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

if ((strlen($_GET['p']) > 0) && ($espacio = strpos($content, " ", $max_char ))) {
      $content = substr($content, 0, $espacio);
      $content = $content;
      echo "<p>";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."... &raquo;</a>";
      echo "</p>";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "<p>";
        echo $content;
        echo "...";
        echo "&nbsp;<a href='";
        the_permalink();
        echo "'>".$more_link_text."</a>";
        echo "</p>";
   }
   else {
      echo "<p>";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."... &raquo;</a>";
      echo "</p>";
   }
}  


add_action('widgets_init', create_function('', 'return register_widget("FavoritesPosts");'));

//--------------------------------- 

function get_custom_field_posts_join($join) {
	global $wpdb, $customFields;
	return $join . "  JOIN $wpdb->postmeta postmeta ON (postmeta.post_id = $wpdb->posts.ID and postmeta.meta_key in ($customFields)) ";
}
function get_custom_field_posts_group($group) {
	global $wpdb;
	$group .= " $wpdb->posts.ID ";
	return $group;
}




?>
