<?php
/*
Template Name: Top 〜トップページ〜
*/
 ?>
<?php get_header(); ?>

<?php get_template_part('content', 'menu'); ?>

    <main>
      <section class="hero container-fluid  js-float-menu-target ">
        <h2 class="hero-title">Kengo's Portfolio Site</h2>
      </section>
      <section class="bgColor-lightGray container-hide" id="profiele">
        <div class="container">
          <h2  class="container-title"><i class="fas fa-user-alt"><span></i> PROFILE</span> </h2>
          <div class="responsive-img-container">
            <img src="<?php echo get_post_meta($post->ID, 'img-profile',true); ?>" alt="">
          </div>
          <div class="container-body">
            <div class="profiele-group profiele-group-bgcolor">
              <div class="profiele-img">
                <img src="<?php echo get_post_meta($post->ID, 'img-profile',true); ?>" alt="">
              </div>
              <div class="profiele-explanation">
                <p>
                  <?php echo nl2br(get_post_meta($post->ID, 'profile', true)); ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class=" container  container-hide" id="skill" >
          <h2  class="container-title"><span><i class="fas fa-lightbulb"></i> SKILL</span></h2>
          <div class="container-body skill-container" >
            <div class="skillbar">
              <div class="skillbar-title"><span>HTML5</span></div>
              <p class="skillbar-bar  skillbar-bar-html">
                <span class="skillbar-percent">80%</span>
              </p>
            </div>
            <div class="skillbar">
              <div class="skillbar-title"><span>CSS3</span></div>
              <p class="skillbar-bar skillbar-bar-css">
                <span class="skillbar-percent">70%</span>
              </p>
            </div>
            <div class="skillbar">
              <div class="skillbar-title"><span>PHP</span></div>
              <p class="skillbar-bar skillbar-bar-php">
                <span class="skillbar-percent">60%</span>
              </p>
            </div>
            <div class="skillbar">
              <div class="skillbar-title"><span>JS</span></div>
              <p class="skillbar-bar  skillbar-bar-js">
                <span class="skillbar-percent">50%</span>
              </p>
            </div>
          </div>
      </section>

      <section  class="bgColor-lightGray container-hide" id="works">
        <div class="container">
          <h1  class="container-title"><span> <i class="fas fa-tasks"></i> WORKS</span></h1>
          <div class="container-body">
            <div class="panel-group panel-group-flex">
                <?php dynamic_sidebar('WORKSパネル'); ?>
            </div>
          </div>
        </div>
      </section>

      <!-- モーダル+画像スライダー -->
      <div class="modal js-show-modal-target">
        <div class="slider">
          <i class="fas fa-arrow-circle-left slider__nav slider__prev js-slide-prev"></i>
          <i class="fas fa-arrow-circle-right slider__nav slider__next js-slide-next"></i>
          <ul class="slider__container">
            <?php dynamic_sidebar('WORKSスライダー'); ?>
         </ul>
        </div>
      </div>
      <div class="cover js-show-modal-cover js-hide-modal"></div>

      <section class="container container-ornament container-hide" id="contact">
        <h2 class="container-title"><span><i class="far fa-envelope"></i> CONTACT</span></h2>
        <div class="container-body">
          <div class="form form-m">
            <?php echo do_shortcode('[contact-form-7 id="26" title="ポートフォリオお問い合わせフォーム"]'); ?>
          </div>
        </div>
      </section>
    </main>

    <?php get_footer(); ?>
