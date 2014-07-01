<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <hgroup>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', RRZE_Theme::textdomain ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <h2 class="entry-format"><?php _e( 'Statusmitteilung', RRZE_Theme::textdomain ); ?></h2>
        </hgroup>
    </header>

    <?php if ( is_search() ) : ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    <?php else : ?>
    <div class="entry-content">
        <div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( '_rrze_status_avatar', '65' ) ); ?></div>

        <?php the_content( __( 'Weiterlesen <span class="meta-nav">&rarr;</span>', RRZE_Theme::textdomain ) ); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Seiten:', RRZE_Theme::textdomain ) . '</span>', 'after' => '</div>' ) ); ?>
    </div>
    <?php endif; ?>

    <footer class="entry-footer">
        <?php if ( comments_open() ) : ?>
        <span class="comments-link">
            <?php comments_popup_link( '<span class="leave-reply">' . __( 'Kommentar hinterlassen', RRZE_Theme::textdomain ) . '</span>', __( '<b>1</b> Kommentar', RRZE_Theme::textdomain ), __( '<b>%</b> Kommentare', RRZE_Theme::textdomain ) ); ?>
        </span>
        <?php endif; ?>
    </footer>
</article>
