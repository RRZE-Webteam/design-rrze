<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', RRZE_Theme::textdomain ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <div class="entry-meta">
            <?php echo Theme_Tags::posted_on(); ?>
        </div>    
    </header>
    <?php if ( is_search() ) : ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    <?php else : ?>
    <div class="entry-content">
        <?php if ( post_password_required() ) : ?>
            <?php the_content( __( 'Weiterlesen <span class="meta-nav">&rarr;</span>', RRZE_Theme::textdomain ) ); ?>

        <?php else : ?>
            <?php
                $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
                if ( $images ) :
                    $total_images = count( $images );
                    $image = array_shift( $images );
                    $image_img_tag = wp_get_attachment_image( $image->ID, 'medium', 0, array( 'class' => 'wp-image-'.$image->ID ) );
            ?>

            <figure class="gallery-thumb">
                <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
            </figure>

            <p>
                <em><?php printf( _n( 'Diese Galerie enthält <a %1$s>%2$s Bild</a>.', 'Diese Galerie enthält <a %1$s>%2$s Bilder</a>.', $total_images, RRZE_Theme::textdomain ),
                    'href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink zu %s', RRZE_Theme::textdomain ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
                    number_format_i18n( $total_images )
                ); ?></em>
            </p>
        <?php endif; ?>
        <?php the_excerpt(); ?>
    <?php endif; ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Seiten:', RRZE_Theme::textdomain ) . '</span>', 'after' => '</div>' ) ); ?>
    </div>
    <?php endif; ?>
    <footer class="entry-footer">
        <?php if( comments_open() ) : ?>
        <div class="ym-wbox">
            <span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Kommentar hinterlassen', RRZE_Theme::textdomain ) . '</span>', __( '<b>1</b> Kommentar', RRZE_Theme::textdomain ), __( '<b>%</b> Kommentare', RRZE_Theme::textdomain ) ); ?></span>
        </div>
        <?php endif; ?>
    </footer>    
</article>
