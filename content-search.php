<div class="ym-cbox">
    <h2 class="ym-skip"><a name="contentmarke" id="contentmarke"><?php _e('Inhalt', RRZE_Theme::textdomain); ?></a></h2>
    <?php if (have_posts()) : ?>

    <header class="page-header">
        <h1 class="page-title"><?php printf(__('Suchergebnisse für: %s', RRZE_Theme::textdomain), '<span>' . get_search_query() . '</span>'); ?></h1>
    </header>

    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', get_post_format()); ?>

    <?php endwhile; ?>

    <?php echo Theme_Tags::pages_nav(); ?>

    <?php else : ?>

    <article id="post-0" class="post no-results not-found">
        <header class="entry-header">
            <h1 class="entry-title"><?php _e('Es konnte nichts gefunden werden.', RRZE_Theme::textdomain); ?></h1>
        </header>

        <div class="entry-content">
            <p><?php _e('Leider konnte nichts gefunden werden. Versuchen Sie es mit anderen Schlüsselwörtern erneut.', RRZE_Theme::textdomain); ?></p>
        </div>
    </article>

    <?php endif; ?>
</div>
