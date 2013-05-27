<div class="ym-cbox">
    <h2 class="ym-skip"><a name="contentmarke" id="contentmarke"><?php _e( 'Inhalt', '_rrze' ); ?></a></h2>
    <?php if( have_posts() ) : ?>

        <header class="page-header">
            <h2 class="page-title"><?php printf( __( 'Suchergebnisse für: %s', '_rrze' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
        </header>

        <?php while( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', get_post_format() ); ?>

        <?php endwhile; ?>

        <?php echo Theme_Tags::pages_nav(); ?>

    <?php else : ?>

        <article id="post-0" class="post no-results not-found">
            <header class="entry-header">
                <h2 class="entry-title"><?php _e( 'Es konnte nichts gefunden werden.', '_rrze' ); ?></h2>
            </header>

            <div class="entry-content">
                <p><?php _e( 'Entschuldigen Sie, aber es konnte nichts gefunden werden. Versuchen Sie es mit anderen Schlüsselwörtern erneut.', '_rrze' ); ?></p>
            </div>
        </article>

    <?php endif; ?>
</div>
