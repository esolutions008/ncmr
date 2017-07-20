<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon-180x180-precomposed.png" rel="apple-touch-icon" sizes="180x180">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon-152x152-precomposed.png" rel="apple-touch-icon" sizes="152x152">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon-144x144-precomposed.png" rel="apple-touch-icon" sizes="144x144">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon-120x120-precomposed.png" rel="apple-touch-icon" sizes="120x120">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon-114x114-precomposed.png" rel="apple-touch-icon" sizes="114x114">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon-76x76-precomposed.png" rel="apple-touch-icon" sizes="76x76">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon-72x72-precomposed.png" rel="apple-touch-icon" sizes="72x72">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/images/touch-icon-192x192.png" rel="shortcut icon">
    <?php wp_head(); ?>
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-64645170-1', 'auto');
    ga('send', 'pageview');
    </script>
  </head>
  <body>
<?php if(is_english()): ?>
  <header class="main-header main-header-english">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 brand">
          <a class="d-inline-block" href="/projects-tag/english"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" /></a>
        </div>
        <div class="col-lg-9">
          <nav>
            <ul>
              <li><a href="/projects-tag/english"><span class="text-lato">PROJECTS</span></a></li>
              <li><a href="/en"><span class="text-lato">COMPANY</span></a></li>
              <li><a href="/en/members"><span class="text-lato">BOARD MEMBERS</span></a></li>
              <li><a href="/en/message"><span class="text-lato">MESSAGE</span></a></li>
              <li><a href="/""><span class="text-lato">JP</span></a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <a class="hidden-lg-up sidr-trigger" id="right-menu" href="#right-menu"><img class="" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-menu.svg" /></a>
  </header>
<?php else: ?>
  <header class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 brand">
          <a class="d-inline-block" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" /></a>
        </div>
        <div class="col-lg-9">
          <nav>
            <ul>
              <li><a href="/services"><span class="text-lato">SERVICES</span><br /><small>事業内容</small></a></li>
              <li><a href="/projects"><span class="text-lato">PROJECTS</span><br /><small>プロジェクト</small></a></li>
              <li><a href="/members"><span class="text-lato">MEMBERS</span><br /><small>メンバー</small></a></li>
              <li><a href="/recruit"><span class="text-lato">RECRUIT</span><br /><small>採用</small></a></li>
              <li><a href="/company"><span class="text-lato">COMPANY</span><br /><small>会社概要</small></a></li>
              <li><a href="/projects-tag/english" style="position:relative;top:-8px;"><span class="text-lato">EN</span></a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <a class="hidden-lg-up sidr-trigger" id="right-menu" href="#right-menu"><img class="" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-menu.svg" /></a>
  </header>
<?php endif; ?>
