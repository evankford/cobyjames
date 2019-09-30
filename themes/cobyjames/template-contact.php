<?php
/**
 * Template Name: Contact Section
 * 
 *  Template Post Type: post, section, page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cobyjames
 */
?>


<section class="front-section section-contacts" id="contact">
    <div class="contact-inner">
    <h2 class="h1 subtle"><?php the_field('header_text');?></h2>
    
    <?php 
    $contacts = get_field('contacts');
    ?>
    
    <div class="contacts__wrap">
      <?php foreach ($contacts as $contact) {?>
       <a target="_blank" rel="nofollow" data-contact-color="<?php echo $contact['color'];?>" class="contact-link" href="<?php echo $contact['url'];?>">
        <h3 class="contact-title h3"><?php echo $contact['title'];?></h3>
          
          <div class="contact-inner">
            <h4 class="h4 black"><?php echo $contact['name'];?></h4>
            <?php if ($contact['at'] != ''){?>
              <p class="bold strong"><?php echo $contact['at'];?></p>
            <?php }?>
            <div class="button small uppercase">Contact<i class="fas fa-arrow-alt-circle-right"></i></div>
          </div>
      </a>
      <?php }?>
    </div>
    
  </div><!-- /.contacts-inner -->
</section>