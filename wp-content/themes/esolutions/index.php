<?php get_template_part('layouts/header'); ?>
  <div class="container">
    <div class="owl-carousel owl-carousel-mv-index">
      <div><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-mv-index_01.jpg"></div>
      <div><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-mv-index_02.jpg" /></div>
      <div><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-mv-index_04.png" /></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-xs-12 offset-sm-1 text-xs-center text-sm-left">
        <h3 class="heading-topbar m-b-0">NEWS<small>ニュース</small></h3></div>
      <div class="col-sm-8 col-xs-12">
        <?php $args = array('posts_per_page'=>3); $the_query = new WP_Query($args); ?>
        <?php if($the_query->have_posts()): ?>
          <?php while($the_query->have_posts()):$the_query->the_post(); ?>
            <div class="row">
              <div class="col-lg-3 m-b-h"><span class="text-muted"><?php the_time('Y年n月j日'); ?></span> <?php echo new_icon(); ?></div>
              <div class="col-lg-9 m-b-h"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="alert alert-warning">登録されているデータがありません</div>
        <?php endif; wp_reset_postdata(); ?>
      </div>
    </div>
    <div class="text-xs-center m-t-1"><a class="btn btn-secondary btn-sm p-x-3 p-y-h m-b-1" href="/news">もっと見る</a></div>
  </div>
  <hr />
  <div class="p-y-2">
    <div class="container">
      <div class="text-xs-center m-b-2">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="heading-topbar">PROJECTS<small>プロジェクト事例</small></h3>
            <p>弊社の事業プロデュース事例をご紹介いたします。</p>
          </div>
        </div>
      </div>
      <div class="row row-eq-height">
      <?php
        $args = array('post_type' => 'projects','posts_per_page' => 6);
        $the_query = new WP_Query($args);
        if($the_query->have_posts()):
      ?>
       <?php while($the_query->have_posts()):$the_query->the_post(); ?>
        <div class="col-md-4 col-sm-6">
          <div class="card">
            <a href="<?php the_permalink(); ?>">
              <?php if(has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
              <?php else: ?>
                <img src="http://placehold.it/600x400/eee/eee">
              <?php endif; ?>
            </a>
            <div class="card-block">
              <p class="m-b-q text-primary child-m-r-h"><?php echo get_the_term_list( $post->ID, 'projects-category' ); ?></p>
              <h4 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4></div>
          </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <div class="text-xs-center m-t-1"><a class="btn btn-secondary btn-sm p-x-3 p-y-h m-b-1" href="/projects">もっと見る</a></div>
    </div>
  </div>
<?php get_template_part('layouts/footer'); ?>
