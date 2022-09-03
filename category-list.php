
1:
<ul class="list-group">
	  <?php
	  $categories = get_categories();
	  $i = 0;
	  foreach ($categories as $category) {
	    $i++;
	    echo '<li class="list-group-item"><a href="' . get_category_link($category->term_id) . '"><span class="text-muted float-left">' . $category->category_count . '</span>' . $category->name . '</a></li>';
	  }
	  ?>
</ul>

2: 
<?php
	$taxonomy = 'category';
	$terms = get_terms($taxonomy);

	if ( $terms && !is_wp_error( $terms ) ) :
	?>
	    <ul>
	        <?php foreach ( $terms as $term ) { ?>
	            <li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
	        <?php } ?>
	    </ul>
	<?php endif;?>

3: 
<?php 
	function x_filter_by_category( $query ) {
if ( $query->is_home() && $query->is_main_query() && isset($_GET['cat_select']) ) {
$query->set( 'cat', implode( ',', $_GET['cat_select'] ) );
}
}
add_action('pre_get_posts', 'x_filter_by_category'); ?>


<form action="<?php echo home_url()?>">
<?php 
  $categories = get_categories(); 
  foreach ($categories as $category) {
  echo '<input type="checkbox" name="cat_select[]" value="'.$category->cat_ID.'"> '.$category->category_nicename.'<br />';
  }
?>
<button type="submit">Filter</button>
</form>

  <aside class="<?php x_sidebar_class(); ?>" role="complementary">
    <?php if ( get_option( 'ups_sidebars' ) != array() ) : ?>
      <?php dynamic_sidebar( apply_filters( 'ups_sidebar', 'sidebar-main' ) ); ?>
    <?php else : ?>
      <?php dynamic_sidebar( 'sidebar-main' ); ?>
    <?php endif; ?>
  </aside>

4: 
<div class="review-fil">
						<h3>Category</h3>
						<div class="cat">
							<?php
							  $categories = get_categories('taxonomy=category');
							  $select = "<select name='cat' id='cat' class='postform'>n";
							  $select.= "<option value='-1'>Select category</option>n";
							  foreach($categories as $category){
							    if($category->count > 0){
							        $select.= "<option value='".$category->slug."'>".$category->name."</option>";
							    }
							  }
							  $select.= "</select>";
							 
							  echo $select;
							?>
							<script type="text/javascript">
							    var dropdown = document.getElementById("cat");
							    function onCatChange() {
							        if ( dropdown.options[dropdown.selectedIndex].value != -1 ) {
							            location.href = "<?php echo home_url();?>/category/"+dropdown.options[dropdown.selectedIndex].value+"/";
							        }
							    }
							    dropdown.onchange = onCatChange;
							</script>
						</div>
					</div>
					

