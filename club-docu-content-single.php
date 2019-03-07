<section id="sample" style="background: url(<?php if( get_field('background') ): ?><?php the_field('background'); ?><?php endif; ?>) no-repeat center center ; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
  <div class="filter">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <span class="font-smoothing text-uppercase"><time datetime="<?php the_time('c');?>" pubdate> <?php the_time('F Y') ?></span>
        <h3 class="font-smoothing"><?php the_title(); ?></h3>
        <p class="infos font-smoothing"><?php if( get_field('annee') ): ?><?php the_field('annee'); ?><?php endif; ?> • <?php if( get_field('duree') ): ?><?php the_field('duree'); ?><?php endif; ?> • <?php if( get_field('langue') ): ?><?php the_field('langue'); ?><?php endif; ?></p>
        <div class="abstract font-smoothing"><?php the_field('synopsis'); ?></div>
        <a href="<?php if( get_field('link') ): ?><?php the_field('link'); ?><?php endif; ?>" class="btn btn-xl btn-default text-capitalize" target="_blank"><i class="fas fa-play"></i>&nbsp;WATCH IT NOW</a>
        <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><div class="hidden-xs"><p>&nbsp;</p></div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-4 hidden-xs">
        <img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive" alt="<?php the_title(); ?>" style="margin-top:50px">
      </div>
    </div>
  </div>
  </div>
</section>