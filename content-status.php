<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <hgroup>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', '_rrze' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <h3 class="entry-format"><?php _e( 'Statusmitteilung', '_rrze' ); ?></h3>
        </hgroup>
    </header>

    <?php if ( is_search() ) : ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    <?php else : ?>
    <div class="entry-content">
        <div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( '_rrze_status_avatar', '65' ) ); ?></div>

        <?php the_content( __( 'Weiterlesen <span class="meta-nav">&rarr;</span>', '_rrze' ) ); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Seiten:', '_rrze' ) . '</span>', 'after' => '</div>' ) ); ?>
    </div>
    <?php endif; ?>

    <footer class="entry-footer">
        <?php if ( comments_open() ) : ?>
        <span class="comments-link">
            <?php comments_popup_link( '<span class="leave-reply">' . __( 'Kommentar hinterlassen', '_rrze' ) . '</span>', __( '<b>1</b> Kommentar', '_rrze' ), __( '<b>%</b> Kommentare', '_rrze' ) ); ?>
        </span>
        <?php endif; ?>
    </footer>
</article>
