                </div>
            </div>
        </div>
        
        <nav id="tecmenu">
            <div class="ym-wrapper">
                <h2 class="ym-skip"><a name="hilfemarke" id="hilfemarke"><?php _e( 'Technisches Menü', '_rrze' ); ?></a></h2>
                <?php wp_nav_menu( 
                        array( 
                            'theme_location' => 'tecmenu',
                            'container_class' => 'navmenu tecmenu',
                            'menu_id' => 'menu-techmenu', 
                            'menu_class' => 'dropdown',
                            'fallback_cb' => '_rrze_tecmenu_fallback'
                        ) 
                      ); 
                ?>                    
            </div>
            <div class="ym-clearfix"></div>
        </nav>
        
        <footer>
            <div class="ym-wrapper">
                <?php if ( is_active_sidebar( 'sidebar-footer-left' ) || is_active_sidebar( 'sidebar-footer-center' ) || is_active_sidebar( 'sidebar-footer-right' ) ) : ?>
                <div class="ym-cbox">
                    <div id="zusatzinfo" class="ym-noprint">	
                        <h2 class="ym-skip"><a name="zusatzinfomarke" id="zusatzinfomarke"><?php _e( 'Zusatzinformationen', '_rrze' ); ?></a></h2>

                        <div class="ym-column">
                            <div class="ym-column linearize-level-1">

                                <aside class="ym-col1">
                                    <?php get_sidebar( 'footer-left' ); ?>
                                </aside>

                                <?php if( count( explode( '-', _rrze_theme_options( 'footer.layout' ) ) ) >= 2 ) : ?>
                                <aside class="ym-col2">
                                    <?php get_sidebar( 'footer-center' ); ?>
                                </aside>
                                
                                <?php endif;?>
                                
                                <?php if( count( explode( '-', _rrze_theme_options( 'footer.layout' ) ) ) >= 3 ) : ?> 
                                <aside class="ym-col3">
                                    <?php get_sidebar( 'footer-right' ); ?>
                                </aside>
                                
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>
