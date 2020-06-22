<?php
/**
 * Template Name: Tour Section
 *
 *  Template Post Type: post, section, page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cobyjames
 */
?>
<section class="front-section section-tour" id="tour">
    <div class="tour-outer">
      <h2 class="hide-me">Tour Dates</h2>
      <div class="tour-image__wrap">
        <?php
          echo '<div class="tour-inner-image">';
          imgwrap(get_field('tour_header')['id'], true, '1200w');
          echo '</div><div class="tour-outer-image">';
          get_template_part('template-parts/tour-svg');
          echo '</div>';
          ?>
        </div>
        <div class="tour-dates__wrap">
          <?php if (get_field('tour_dates_header') || get_field('above_dates_subtext')) {
              echo '<div class="tour-dates__header">';
                if (get_field('tour_dates_header')) {
                  echo '<h3 class="subtle-header h3">' . get_field('tour_dates_header') . '</h3>';

                }?>
                <?php if (get_field('above_dates_subtext')) {
                  echo '<h4 class="light h5">' . get_field('above_dates_subtext') . '</h4>';

                }
              echo '</div>';
            }
            ?>
          <div class="tour-dates-wrap" data-module="bandsintown" data-fallback="bit-fallback" data-artist="Coby James" data-app-id="LDsite" data-filter="LDsite" data-limit="<?php the_field('dates_number');?>" data-show-lineup="false" data-date-format="short numbers" data-year="false">
            <h3 class="h3 loader">
              <span>L</span>
              <span>O</span>
              <span>A</span>
              <span>D</span>
              <span>I</span>
              <span>N</span>
              <span>G</span>
              <span>.</span>
              <span>.</span>
              <span>.</span>
            </h3>
            <div class="fallback hidden h3"  aria-hidden>More Dates Coming Soon
            </div>
              <div class="error hidden">Error Loading Dates</div>
            <div class="tour-dates-expand big hidden button accent blue" data-expand-bit><?php the_field('dates_expander');?></div>
          </div>
        </div>
    </div>
</section>