<?php
/**
 * Template Name: Intro Section
 *
 *  Template Post Type: post, section, page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cobyjames
 */
?>


<section class="front-section section-intro" id="intro">

    <div class="intro-bg" id="parallax-scene" data-relative-input="false" data-module="parallax">
      <header class="title" data-depth="0.15">
        <?php if (get_field('title')) { echo '<h1 aria-label="'. get_field('title')['alt'] . '">';  imgwrap(get_field('title')['id'], false, '750w'); echo '</h1>';} else {?>
        <h1 >
          <?php the_custom_logo();?>
        </h1>
        <?php }?>
      </header>
      <div class="background-image" data-depth="0.3">
        <?php imgwrap(get_field('background_image')['id'], true, '3000w');?>
      </div>
      <?php if (get_field('coby_image') != null) {?>
      <div class="coby" data-depth="0.15">

        <?php imgwrap(get_field('coby_image')['id'], false, '600w');?>
      </div>

      <div class="circle-outer" data-depth="0.23">
      <svg class="circle" viewBox="0 0 681 681" version="1.1" >
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.820103237">
              <g id="r" transform="translate(-711.000000, -258.000000)" stroke="#FFFFFF" stroke-width="4">
                  <circle id="Oval" cx="1051.5" cy="598.5" r="338.5"></circle>
              </g>
          </g>
      </svg>
      </div>
      <?php if (get_field('ticket_image')) {?>
      <div class="ticket" data-depth="0.1">
        <?php imgwrap(get_field('ticket_image')['id']);?>
      </div>

      <?php }
      }?>
    </div>
    <?php if (get_field('button_url')) {?>
      <div class="button-wrap"><a href="<?php echo get_field('button_url')['url'];?>" class="button big light" <?php if (get_field('button_url')['target'] == '_blank') { echo 'target="_blank" rel="nofollow noreferrer"';}?>><?php echo get_field('button_url')['title'];?></a></div>
    <?php }?>
    <nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'cobyjames' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
      <?php if (get_field('stereo_image')) {
        imgwrap(get_field('stereo_image')['id'], false, '450w');
      }?>
		</nav><!-- #site-navigation -->
    <div class="email-signup">
        <div class="tour-mc"><link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
          <style type="text/css">#mc_embed_signup{background:transparent; clear:left;  width:100%;}</style>
          <div id="mc_embed_signup">
            <form action="https://centricitymusic.us7.list-manage.com/subscribe/post?u=7e27c8f8d7069d7722d689068&amp;id=219c4c8f73" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
              <div id="mc_embed_signup_scroll">
                <label class="bit-label" for="mce-EMAIL"><?php the_field('email_header');?></label>
               <div class="mc-group input-wrap">

                  <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required="">
               </div>
               <div class="mc-group button-wrap">
                  <div style="position: absolute; left: -5000px;" aria-hidden="true">
                    <input type="text" name="b_7e27c8f8d7069d7722d689068_2469f52d67" tabindex="-1" value="">
                  </div>
                  <button type="submit" class="button clear light outline" value="Sign Up" name="subscribe" id="mc-embedded-subscribe"><i class="fas fa-arrow-alt-circle-right" aria-label="submit"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</section>