
<div class="container m-b-2">
<?php if(!is_home()): ?>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>/">HOME</a></li>
      <?php if(is_search()): ?><li class="breadcrumb-item active">「<?php the_search_query(); ?>」で検索した結果</li>
      <?php elseif(is_tag()): ?><li class="breadcrumb-item active"><?php single_tag_title(); ?></li>
      <?php elseif(is_author()): ?><li class="breadcrumb-item active"><?php the_author_meta('display_name', get_query_var('author')); ?></li>
      <?php elseif(is_404()): ?><li class="breadcrumb-item active">404 Not found</li>
      <?php elseif(is_date()): ?>
        <?php if(is_day()): ?>
          <li class="breadcrumb-item"><a href="<?php echo get_year_link(get_query_var('year')); ?>"><?php echo get_query_var('year'); ?>年</a></li>
          <li class="breadcrumb-item"><a href="<?php echo get_month_link(get_query_var('year'), get_query_var('monthnum')); ?>"><?php echo get_query_var('monthnum'); ?>月</a></li>
          <li class="breadcrumb-item active"><?php echo get_query_var('day'); ?>日</li>
        <?php elseif(is_month()): ?>
          <li class="breadcrumb-item"><a href="<?php echo get_year_link(get_query_var('year')); ?>"><?php echo get_query_var('year'); ?>年</a></li>
          <li class="breadcrumb-item active"><?php echo get_query_var('monthnum'); ?>月</li>
        <?php elseif(is_year()): ?>
          <li class="breadcrumb-item active"><?php echo get_query_var('year'); ?>年</li>
        <?php endif; ?>
      <?php elseif(is_category()): ?>
        <?php $cat = get_queried_object(); ?>
        <?php if($cat -> parent != 0): ?>
          <?php $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' )); ?>
          <?php foreach($ancestors as $ancestor): ?>
            <li class="breadcrumb-item"><a href="<?php echo get_category_link($ancestor); ?>"><?php echo get_cat_name($ancestor); ?></a></li>
          <?php endforeach; ?>
        <?php endif; ?>
        <li class="breadcrumb-item active"><?php echo $cat -> cat_name; ?></li>
      <?php elseif(is_page()): ?>
        <?php if($post -> post_parent != 0 ): ?>
          <?php $ancestors = array_reverse( $post-> ancestors ); ?>
          <?php foreach($ancestors as $ancestor): ?>
            <li class="breadcrumb-item"><a href="<?php echo get_permalink($ancestor); ?>"><?php echo get_the_title($ancestor); ?></a></li>
          <?php endforeach; ?>
        <?php endif; ?>
        <li class="breadcrumb-item active"><?php echo $post -> post_title; ?></li>
      <?php elseif(is_attachment()): ?>
        <?php if($post -> post_parent != 0 ): ?>
          <li class="breadcrumb-item"><a href="<?php echo get_permalink($post -> post_parent); ?>"><?php echo get_the_title($post -> post_parent); ?></a></li>
        <?php endif; ?>
        <li class="breadcrumb-item active"><?php echo $post -> post_title; ?></li>
      <?php elseif(is_singular('post')): ?>
        <?php $categories = get_the_category($post->ID); ?>
        <?php $cat = $categories[0]; ?>
        <?php if($cat -> parent != 0): ?>
          <?php $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' )); ?>
          <?php foreach($ancestors as $ancestor): ?>
            <li class="breadcrumb-item"><a href="<?php echo get_category_link($ancestor); ?>"><?php echo get_cat_name($ancestor); ?></a></li>
          <?php endforeach; ?>
        <?php endif; ?>
        <li class="breadcrumb-item"><a href="<?php echo get_category_link($cat -> cat_ID); ?>"><?php echo $cat-> cat_name; ?></a></li>
        <li class="breadcrumb-item active"><?php echo $post -> post_title; ?></li>
      <?php elseif(is_tax()): ?>
        <?php
          $term_breadcrumb = get_term_by("slug", get_query_var("term"), get_query_var("taxonomy") );
          $tmpTerm = $term_breadcrumb;
          $tmpCrumbs = array();
            while ($tmpTerm->parent > 0){
              $tmpTerm = get_term($tmpTerm->parent, get_query_var("taxonomy"));
              $crumb = '<li class="breadcrumb-item"><a href="' . get_term_link($tmpTerm, get_query_var('taxonomy')) . '">' . $tmpTerm->name . '</a></li>';
                array_push($tmpCrumbs, $crumb);
            };
          echo implode('', array_reverse($tmpCrumbs));
        ?>
        <li class="breadcrumb-item active"><?php single_term_title(); ?></li>
      <?php else: ?>
        <li class="breadcrumb-item active"><?php wp_title('', true); ?></li>
      <?php endif; ?>
    </ol>
<?php endif; ?>
</div>
