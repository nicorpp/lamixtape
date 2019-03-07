<?php /* Template Name: legals */ ?>
<?php get_header(); ?>
<section class="container legals">
	<hr>
	<aside class="font-smoothing">
		<div class="row">
			<div class="col-md-6">
				<p>Lamixtape.fr — Music discovery service<br><small>&rarr; Last update: <?php the_modified_date('F, Y'); ?></small></p>
			</div>
			<div class="col-md-6 text-right">
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
				endwhile; else: ?>
				<?php endif; ?>
			</div>
			<div class="col-md-3">
			</div>
		</div>
	</aside>
	<footer class="font-smoothing">
		<hr>
		<div class="row">
			<div class="col-md-6 col-xs-8">
				<small>© <?php echo date("Y"); ?>, Lamixtape &#8226; <a href="<?php echo get_bloginfo( 'wpurl' );?>/legals" class="underline">Impressum</a></small>
			</div>
			<div class="col-sm-6 col-xs-4 text-right" >
	      <small data-toggle="tooltip" data-placement="left" title="" data-original-title="Last update: <?php the_modified_date('F, Y'); ?>">v3.4</small>
	    </div>
		</div>
	</footer>
</section>
<?php get_footer(); ?>
