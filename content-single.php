<div class="ym-cbox">
    <h2 class="ym-skip"><a name="contentmarke" id="contentmarke"><?php _e( 'Inhalt', '_rrze'); ?></a></h2>
    <?php while( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <h2><?php the_title(); ?></h2>
                <?php if( 'post' == get_post_type() ) : ?>
                    <div class="entry-meta">
                        <?php echo Theme_Tags::posted_on(); ?>
                    </div>
                <?php endif; ?>   
            </header>

            <div class="entry-content">
                <?php the_content( __( 'Weiterlesen <span class="meta-nav">&rarr;</span>', '_rrze' ) ); ?>
                <?php wp_link_pages( array( 'before' => '<nav id="nav-pages"><div class="ym-wbox"><span>' . __( 'Seiten:', '_rrze' ) . '</span>', 'after' => '</div></nav>' ) ); ?>
            </div>

            <footer class="entry-footer clear">
                <div class="ym-wbox">
                    <?php
                    $categories_list = get_the_category_list(', ');

                    $tag_list = get_the_tag_list('', ', ');
                    if( '' != $tag_list ) {
                        $utility_text = __('Dieser Eintrag wurde veröffentlicht in %1$s und verschlagwortet mit %2$s von <a href="%6$s">%5$s</a>. <a href="%3$s" title="Permalink zu %4$s" rel="bookmark">Permanenter Link zum Eintrag</a>.', '_rrze' );
                    } elseif( '' != $categories_list ) {
                        $utility_text = __( 'Dieser Eintrag wurde veröffentlicht in %1$s von <a href="%6$s">%5$s</a>. <a href="%3$s" title="Permalink zu %4$s" rel="bookmark">Permanenter Link des Eintrags</a>.', '_rrze' );
                    } else {
                        $utility_text = __( 'Dieser Eintrag wurde von <a href="%6$s">%5$s</a> veröffentlicht. Lesezeichen zum <a href="%3$s" title="Permalink zu %4$s" rel="bookmark">Artikel setzen</a>.', '_rrze' );
                    }

                    printf($utility_text, $categories_list, $tag_list, esc_url( get_permalink()), the_title_attribute( 'echo=0' ), get_the_author(), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) );
                    ?>
                    <?php edit_post_link( __( '(Bearbeiten)', '_rrze' ), '<span class="edit-link">', '</span>' ); ?>
                </div>
            </footer>

        </article>

        <nav id="nav-single">
            <div class="ym-wbox">
                <h3 class="ym-skip"><?php _e( 'Artikelnavigation', '_rrze' ); ?></h3>
                <div class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Vorherige', '_rrze' ) ); ?></div>
                <div class="nav-next"><?php next_post_link( '%link', __( 'Nächste <span class="meta-nav">&rarr;</span>', '_rrze' ) ); ?></div>
            </div>
        </nav>
    
        <?php comments_template( '', true ); ?>

    <?php endwhile; ?>

</div>
