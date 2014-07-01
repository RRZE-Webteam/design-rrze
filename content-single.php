<h2 class="ym-skip"><a name="contentmarke" id="contentmarke"><?php _e( 'Inhalt', RRZE_Theme::textdomain); ?></a></h2>
<?php while( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
            <h1><?php the_title(); ?></h1>
            <?php if( 'post' == get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php echo Theme_Tags::posted_on(); ?>
                </div>
            <?php endif; ?>   
        </header>

        <div class="entry-content">
            <?php the_content( __( 'Weiterlesen <span class="meta-nav">&rarr;</span>', RRZE_Theme::textdomain ) ); ?>
            <?php wp_link_pages( array( 'before' => '<nav id="nav-pages"><div class="ym-wbox"><span>' . __( 'Seiten:', RRZE_Theme::textdomain ) . '</span>', 'after' => '</div></nav>' ) ); ?>
        </div>

        <footer class="entry-footer">
            <div class="ym-wbox">
                <?php
                $categories_list = get_the_category_list(', ');

                $tag_list = get_the_tag_list('', ', ');
                if( '' != $tag_list ) {
                    $utility_text = __('Dieser Eintrag wurde veröffentlicht in %1$s und verschlagwortet mit %2$s von <a href="%4$s">%3$s</a>.', RRZE_Theme::textdomain );
                } elseif( '' != $categories_list ) {
                    $utility_text = __( 'Dieser Eintrag wurde veröffentlicht in %1$s von <a href="%4$s">%3$s</a>.', RRZE_Theme::textdomain );
                } else {
                    $utility_text = __( 'Dieser Eintrag wurde von <a href="%4$s">%3$s</a> veröffentlicht.', RRZE_Theme::textdomain );
                }

                printf($utility_text, $categories_list, $tag_list, get_the_author(), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) );
                
                $permalink = sprintf(__('<a href="%1$s" title="Permalink zu %2$s" rel="bookmark">Permanenter Link zum Eintrag</a>', 'rrze'), esc_url( get_permalink()), the_title_attribute( 'echo=0' ));
                printf('<span class="permalink">%s</span>', $permalink);
                ?>
                <?php edit_post_link( __( '(Bearbeiten)', RRZE_Theme::textdomain ), '<span class="edit-link">', '</span>' ); ?>
            </div>
        </footer>

    </article>

    <nav id="nav-single">
        <div class="ym-wbox">
            <h3 class="ym-skip"><?php _e( 'Artikelnavigation', RRZE_Theme::textdomain ); ?></h3>
            <div class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Vorherige', RRZE_Theme::textdomain ) ); ?></div>
            <div class="nav-next"><?php next_post_link( '%link', __( 'Nächste <span class="meta-nav">&rarr;</span>', RRZE_Theme::textdomain ) ); ?></div>
        </div>
    </nav>

    <?php comments_template( '', true ); ?>

<?php endwhile; ?>
