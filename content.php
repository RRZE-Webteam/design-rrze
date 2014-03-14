<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h2>
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', '_rrze' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>
        <?php if( 'post' == get_post_type() ) : ?>
            <div class="entry-meta">
                <?php echo Theme_Tags::posted_on(); ?>
            </div>
        <?php endif; ?>               
    </header>
    <?php if( is_search() ) : ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    <?php else : ?>
        <div class="entry-content">
           
            <?php $options = _rrze_theme_options();
            if ($options['blog.overview']=='rrze_content') :
                the_content( __( 'Weiterlesen <span class="meta-nav">&rarr;</span>', '_rrze' ) );
            else :
                if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', '_rrze' ), the_title_attribute( 'echo=0' ) ); ?>">
                        <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft rrze-margin')); ?>
                    </a>
                <?php endif;
                the_excerpt(); ?>            
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', '_rrze' ), the_title_attribute( 'echo=0' ) ); ?>" class="alignright permalink rrze-margin"><?php printf( __( 'Vollständigen Artikel lesen <span class="meta-nav">&rarr;</span>', '_rrze' ) ); ?></a>    
            <?php endif; ?>
            <?php wp_link_pages( array( 'before' => '<nav id="nav-pages"><div class="ym-wbox"><span>' . __( 'Seiten:', '_rrze' ) . '</span>', 'after' => '</div></nav>' ) ); ?>
        </div>
    <?php endif; ?>
    <footer class="entry-footer">
        <?php if( comments_open() ) : ?>
        <div class="ym-wbox">
            <span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Kommentar hinterlassen', '_rrze' ) . '</span>', __( '<b>1</b> Kommentar', '_rrze' ), __( '<b>%</b> Kommentare', '_rrze' ) ); ?></span>
        </div>
        <?php endif; ?>
    </footer>    
</article>
