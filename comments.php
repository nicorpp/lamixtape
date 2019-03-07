<?php if ( have_comments() ) : ?>
<ul class="list-unstyled">
  <?php wp_list_comments( 'type=comment&callback=tape_comment' ); ?>
</ul>
<?php endif; ?>
