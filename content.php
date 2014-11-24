<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if (is_search()) : ?>
            <h2><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink zu %s', RRZE_Theme::textdomain), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <?php else : ?>
            <h1><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink zu %s', RRZE_Theme::textdomain), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php endif; ?>
        <?php if ('post' == get_post_type()) : ?>
            <div class="entry-meta">
                <?php echo Theme_Tags::posted_on(); ?>
            </div>
        <?php endif; ?>               
    </header>
    <?php if (is_search()) : ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    <?php else : ?>
        <div class="entry-content">
            <?php
            $options = _rrze_theme_options();
            if ($options['blog.overview'] == 'rrze_content') :
                the_content(__('Weiterlesen', RRZE_Theme::textdomain) . ' <span class="meta-nav">&rarr;</span>');
            else :
                if (!post_password_required() && !is_attachment() ) :
                    ?> 
                    <div class="entry-thumbnail">
                        <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink zu %s', RRZE_Theme::textdomain), the_title_attribute('echo=0')); ?>">                        
                       <?php _rrze_get_thumbnailcode(); ?> 
                        </a> 
                    </div>
                <?php endif;
                the_excerpt();
                ?>            
                <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink zu %s', RRZE_Theme::textdomain), the_title_attribute('echo=0')); ?>" class="alignright permalink rrze-margin"><?php printf(__('Vollständigen Artikel lesen <span class="meta-nav">&rarr;</span>', RRZE_Theme::textdomain)); ?></a>    
            <?php endif; ?>
            <?php wp_link_pages(array('before' => '<nav id="nav-pages"><div class="ym-wbox"><span>' . __('Seiten:', RRZE_Theme::textdomain) . '</span>', 'after' => '</div></nav>')); ?>
        </div>
    <?php endif; ?>
    <footer class="entry-footer">
        <?php if (comments_open()) : ?>
            <div class="ym-wbox">
                <span class="comments-link"><?php comments_popup_link('<span class="leave-reply">' . __('Kommentar hinterlassen', RRZE_Theme::textdomain) . '</span>', __('<b>1</b> Kommentar', RRZE_Theme::textdomain), __('<b>%</b> Kommentare', RRZE_Theme::textdomain)); ?></span>
            </div>
    <?php endif; ?>
    </footer>    
</article>
