<?php /* Template Name: about */ ?>
<?php get_header(); ?>
<section class="container about">
	<hr>
	<article class="row font-smoothing">
		<div class="col-md-9 col-xs-12">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			the_content();
			endwhile; else: ?>
			<?php endif; ?>
			<p>And remember, <?php $posts = get_posts('orderby=rand&numberposts=1'); foreach($posts as $post) { ?><a class="" href="<?php the_permalink(); ?>">getting lost</a><?php } ?> can be good.</p>
			<div style="display:none"><?php echo do_shortcode('[asp_product id="4018"]'); ?></div>
		</div>
		<div class="col-md-3 text-right hidden-xs hidden-sm">
			<ul class="list-unstyled socials">
				<li><a href="https://www.instagram.com/lamixtape/" target="_blank"><i class="fab fa-instagram"></i></a></li>
				<li><a href="https://www.facebook.com/Lamixtape/" target="_blank"><i class="fab fa-facebook"></i></a></li>
				<li><a href="https://twitter.com/lamixtape" target="_blank"><i class="fab fa-twitter"></i></a></li>
				<li><a href="https://www.youtube.com/channel/UCC6KvX3PCah6yWMCP6BFOYA" target="_blank"><i class="fab fa-youtube"></i></a></li>
				<li><a href="https://open.spotify.com/user/lqlazk6qaqic3t5jpbo8e9x4l?si=PwSAiOdVQU6Tr1Uw4rBsWQ" target="_blank"><i class="fab fa-spotify"></i></a></li>
				<li><a href="https://itunes.apple.com/profile/Lamixtape" target="_blank"><i class="fab fa-apple"></i></a></li>
		</div>
	</article>
	<footer class="font-smoothing">
		<hr>
		<div class="row">
			<div class="col-md-6 col-xs-8">
				<small>© <?php echo date("Y"); ?>, Lamixtape &#8226; <a href="<?php echo get_bloginfo( 'wpurl' );?>/legals" class="">Impressum</a></small>
			</div>
			<div class="col-sm-6 col-xs-4 text-right" >
	      <small data-toggle="tooltip" data-placement="left" title="" data-original-title="Last update: <?php the_modified_date('F, Y'); ?>">v3.4</small>
	    </div>
		</div>
	</footer>
</section>
<?php get_footer(); ?>
