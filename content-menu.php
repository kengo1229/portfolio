<header class="header js-float-menu">
  <h1 class="title">Web Engineer</h1>
  <div class="menu-trigger js-toggle-sp-menu">
    <span></span>
    <span></span>
    <span></span>
  </div>
    <?php wp_nav_menu( array(
      'theme_location'=>'mainmenu2',
      'container'     =>'nav',
      'container_class' => 'nav-menu js-toggle-sp-menu-target',
      "menu_id" => "",
      'menu_class'    =>'menu',
    )) ?>

</header>
