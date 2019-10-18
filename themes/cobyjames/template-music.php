<?php
/**
 * Template Name: Music Section
 * 
 *  Template Post Type: post, section, page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cobyjames
 */
?>


<section class="front-section section-music" id="music">
    <div class="music-inner">
    <h2 class="h1 subtle">Music</h2>
    
    <?php 
    $releases = get_field('releases');
    $is_slider = false;
    if (count($releases)> 1) {
      $is_slider = true;
    }
      if ($is_slider) {
        $dots = 'false';
        $arrows = 'false';
        $settings = get_field('slider-settings');
        if ($settings['slider_dots'] > 0) {
          $dots = 'true';
        } 
        if ($settings['slider_arrows'] > 0) {
          $arrows = 'true';
        } 
        
        echo '<div class="swiper-container" data-module="swiper" data-swiper-type="music" data-swiper-arrows="' . $arrows . '" data-swiper-pagination="' . $dots .'">';
      } else {
        echo '<div class="swiper-container music-slider">';
      }
      echo '<div class="swiper-wrapper">';
      foreach ($releases as $release) {?>
       <div class="swiper-slide single-release">
          <div class="release-inner">
            <div class="release-image__wrap">
              <?php imgwrap( $release['image']['id'], false, '900w');?>
            </div>
            <div class="release-content">
              <h3 class="h2"><?php echo $release['title'];?></h3>
              <div class="release-links">
                <?php foreach ($release['links'] as $link) {
                  echo '<a class="release-link" href="' . $link['url'] . '" target="_blank" rel="nofollow"><i class="' . $link['icon_classes'] . '" aria-label="'. $link['text'] .'"></i></a>';
                }?>
              </div>
              <?php if ($release['more_text']) {
                echo '<p class="more-text">' . $release['more_text'] .'</p>';
              }?>
              <?php if ($release['button_text'] && $release['button_url']) {
                echo '<a class="button dark" target="_blank" rel="nofollow" href="' . $release['button_url'] . '">' . $release['button_text'] .'</a>';
              }?>
            </div>
          </div>
        </div>
      <?php }
      
      echo '</div>';
      if ($is_slider) {
        echo '<div class="swiper-pagination"></div>
        <div class="swiper-button-prev"><i class="fas fa-caret-left"></i></div>
        <div class="swiper-button-next"><i class="fas fa-caret-right"></i></div>';
      }
      echo '</div>';
      ?>
    </div><!--/swiper-container-->
     
</section>