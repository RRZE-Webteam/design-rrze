<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <hgroup>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', RRZE_Theme::textdomain ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <h3 class="entry-format"><?php _e( 'Kurzmitteilung', RRZE_Theme::textdomain ); ?></h3>
        </hgroup>

        <?php if ( comments_open() && ! post_password_required() ) : ?>
        <div class="comments-link">
            <?php comments_popup_link( '<span class="leave-reply">' . __( 'Kommentar', RRZE_Theme::textdomain ) . '</span>', _x( '1', '1', RRZE_Theme::textdomain ), _x( '%', '%', RRZE_Theme::textdomain ) ); ?>
        </div>
        <?php endif; ?>
    </header>

    <?php if ( is_search() ) : ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    <?php else : ?>
    <div class="entry-content">
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
