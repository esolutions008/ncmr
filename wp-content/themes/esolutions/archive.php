<?php get_template_part('layouts/header'); ?>
<?php get_template_part('layouts/breadcrumb'); ?>
  <main>
    <div class="container">
      <?php if(is_category('news')) : ?>
      <h1>PRESS RELEASE<br><small class="m-l-0">プレスリリース</small></h1>
      <?php elseif(is_category('seminar')): ?>
      <h1>SEMINAR<br><small class="m-l-0">講演実績</small></h1>
      <?php endif; ?>
      <?php if(have_posts()): ?>
      <div class="row">
        <?php while(have_posts()):the_post(); ?>
        <div class="col-lg-12">
          <div class="card">
            <dl class="card-block card-news">
              <dt><span><?php the_time('Y年n月j日'); ?></span>
                <h3><?php the_title(); ?></h3></dt>
              <dd>
                <?php the_content(); ?>
              </dd>
            </dl>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
      <?php if (function_exists("wp_bs_pagination")) { wp_bs_pagination(); } ?>
      <?php else: ?>
        <div class="alert alert-warning m-b-lg"><p>登録されている投稿はありません。</p></div>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </main>


<?php get_template_part('layouts/footer'); ?>
