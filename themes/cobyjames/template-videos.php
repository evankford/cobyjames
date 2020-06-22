<?php
/**
 * Template Name: Videos Section
 *
 *  Template Post Type: post, section, page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cobyjames
 */
?>


<section class="front-section section-videos" id="video">
    <div class="videos-inner">
    <h2 class="h2 subtle"><?php the_field('header_text');?></h2>

    <?php
    $videos = get_field('videos');
    $is_slider = false;
    if (count($videos) > 1) {
      $is_slider = true;
    }
      if ($is_slider) {
        $dots = 'false';
        $arrows = 'false';
        if (get_field('slider_dots') > 0) {
          $dots = 'true';
        }
        if (get_field('slider_arrows') > 0) {
          $arrows = 'true';
        }
        echo '<div class="swiper-container videos-wrap" data-module="swiper" data-swiper-type="video" data-swiper-arrows="' . $arrows . '" data-swiper-pagination="' . $dots .'">';
      } else {
        echo '<div class="swiper-container videos-wrap">';
      }
      echo '<div class="swiper-wrapper">';
      foreach ($videos as $video) {?>
       <a  target="_blank" rel="nofollow" class="swiper-slide single-video" href="<?php echo $video['url'];?>">
          <div class="video-inner">
            <div class="video-background">
              <?php vidimg($video['fallback_image']['id'], $video['mp4'], $video['webm'], true, '1500w');?>
            </div>
            <div class="video-content">
              <div class="video-header">
                <h3 class="h2"><?php echo $video['title'];?></h3>
                <?php if ($video['subtitle']) {?>
                  <p class="h4 light"><?php echo $video['subtitle'];?><p>
                <?php }?>
              </div>
              <h3 class="h3 video-footer"><?php echo $video['watch_text'];?></h3>
            </div>
          </div>
        </a>
      <?php }

      echo '</div>';
      if ($is_slider) {
        echo '<div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>';
        echo '</div>';
      }
      ?>
    <?php
    if (get_field('more_button_text') && get_field('more_button_url')) {
      echo '<p class="button-wrap"><a href="' . get_field('more_button_url') . '" class="button pink big"><i class="fab fa-youtube"></i>' .  get_field('more_button_text') . '</a>';
    }?>
  </div><!-- /.videos-inner -->
</section>