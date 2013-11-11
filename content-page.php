<h2 class="ym-skip"><a name="contentmarke" id="contentmarke"><?php _e( 'Inhalt', '_rrze' ); ?></a></h2>

<?php while( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if( ! get_field( 'titel_ausblenden' ) ) : ?>
        <header class="entry-header">
            <h2><?php the_title(); ?></h2>
        </header>
        <?php endif; ?>

        <div class="entry-content">
            <?php the_content( __( 'Weiterlesen <span class="meta-nav">&rarr;</span>', '_rrze' ) ); ?>
            <?php wp_link_pages( array( 'before' => '<nav id="nav-pages"><div class="ym-wbox"><span>' . __( 'Seiten:', '_rrze' ) . '</span>', 'after' => '</div></nav>' ) ); ?>
        </div>

        <footer class="entry-meta">
            <?php edit_post_link( __( '(Bearbeiten)', '_rrze' ), '<div class="ym-wbox"><span class="edit-link">', '</span></div>' ); ?>
        </footer>
    </article>

    <?php comments_template( '', true ); ?>

<?php endwhile; ?>
