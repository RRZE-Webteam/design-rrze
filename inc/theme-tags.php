<?php
class Theme_Tags {

    public static function search_form( $formclass = 'ym-searchform', $fieldclass = 'ym-searchfield', $buttonclass = 'ym-searchbutton' ) {
        $form = sprintf(
            '<form class="%s" role="search" method="get" id="searchform" action="%s" >
                <input class="%s" type="search" placeholder="%s" value="%s" name="s" id="s" />
                <input class="%s" type="submit" value="%s" />
            </form>', $formclass, esc_url( home_url( '/' ) ), $fieldclass, esc_attr__( 'Suchen...', '_rrze' ), get_search_query(), $buttonclass, esc_attr__( 'Suchen', '_rrze' ) );
        return $form;
    }

    public static function breadcrumb_nav() {
        global $post;

        $list = sprintf( '<ul><li><span>%s</span></li>', __( 'Sie befinden sich hier:', '_rrze' ) );

        if ( ! is_front_page() ) {
            $list .= sprintf( '<li><a href="%s">%s</a><span>»</span></li>', get_bloginfo('url'), __('Startseite', '_rrze' ) );

            if ( is_category() ) {
                $list .= sprintf( '<li><span>%s %s</span></li>', __('Kategorie', '_rrze' ), single_cat_title( '', false) );

            } elseif ( is_tag() ) {
                $list .= sprintf( '<li><span>%s %s</span></li>', __('Tag', '_rrze' ), single_cat_title( '', false) );

            } elseif ( is_archive() ) {
                $list .= sprintf( '<li><span>%s %s</span></li>', __( 'Archive', '_rrze' ), single_cat_title( '', false) );

            } elseif ( is_author() ) {
                $list .= sprintf( '<li><span>%s %s</span></li>', __( 'Autor', '_rrze' ), single_cat_title( '', false) );

            } elseif ( is_single() ) {
                if ( get_option( 'page_for_posts') )
                    $list .= sprintf( '<li><a href="%s">%s</a><span>»</span></li>', get_permalink( get_option( 'page_for_posts' ) ), get_the_title( get_option( 'page_for_posts' ) ) );
                $list .= sprintf( '<li><span>%s</span></li>', get_the_title( $post->ID) );

            } elseif ( ( is_home() || is_date () ) && get_option( 'page_for_posts' ) ) {
                $list .= sprintf( '<li><span>%s</span></li>', get_the_title(get_option( 'page_for_posts') ) );

            } elseif ( is_page() ) {
                if ( $post->post_parent ) {
                    $home = get_page( $post->ID );
                    for ( $i = count( $post->ancestors ) - 1; $i >= 0; $i-- ) {
                        if ( $home->ID != $post->ancestors[$i] ) {
                            $list .= sprintf( '<li><a href="%s">%s</a><span>»</span></li>', get_permalink( $post->ancestors[$i] ), get_the_title( $post->ancestors[$i] ) );
                        }
                    }
                }
                $list .= sprintf( '<li><span>%s</span></li>', get_the_title( $post->ID ) );

            } elseif ( is_search() ) {
                $list .= sprintf( '<li><span>%s</span></li>', sprintf( __( 'Suchergebnisse für: %s', '_rrze' ), '<span>' . get_search_query() . '</span>') );
            }
        } else {
            $list .= sprintf( '<li><span>%s</span></li>', __( 'Startseite', '_rrze' ) );
        }
        $list .= '</ul>';

        return $list;
    }

    public static function pages_nav() {
        global $wp_query;

        if ( $wp_query->max_num_pages > 1 ) :
            ?>

            <nav id="nav-pages">
                <div class="ym-wbox">
                    <h3 class="ym-skip"><?php _e( 'Suchergebnissenavigation', '_rrze' ); ?></h3>
                    <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Vorherige', '_rrze' ) ); ?></div>
                    <div class="nav-next"><?php previous_posts_link( __( 'Nächste <span class="meta-nav">&rarr;</span>', '_rrze' ) ); ?></div>
                </div>
            </nav>

        <?php
        endif;
    }

    public static function posted_on() {
        return sprintf(__( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', '_rrze' ), 
                esc_url( get_permalink() ), 
                esc_attr( get_the_time() ), 
                esc_attr( get_the_date('c') ), 
                esc_html( get_the_date() )
        );
    }

    public static function comment_form( $args = array(), $post_id = null ) {
        global $id;

        if ( null === $post_id )
            $post_id = $id;
        else
            $id = $post_id;

        $commenter = wp_get_current_commenter();
        $user = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $fields =  array(
            'author' => '<div class="comment-form-author ym-fbox-text">' . '<label for="author">' . __( 'Name', '_rrze' ) . ( $req ? '<span class="required-item">*</span>' : '' ) . '</label> ' .
                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></div>',
            'email'  => '<div class="comment-form-email ym-fbox-text"><label for="email">' . __( 'E-Mail', '_rrze' ) . ( $req ? '<span class="required-item">*</span>' : '' ) . '</label> ' . 
                        '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></div>',
            'url'    => '<div class="comment-form-url ym-fbox-text"><label for="url">' . __( 'Webauftritt', '_rrze' ) . '</label>' .
                        '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>',
        );

        $required_text = sprintf( ' ' . __( 'Erforderliche Felder sind %s markiert', '_rrze' ), '<span class="required">*</span>' );
        $defaults = array(
            'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
            'comment_field'        => '<div class="comment-form-comment ym-fbox-text"><label for="comment">' . __( 'Kommentar', '_rrze' ) . '</label><textarea id="comment" name="comment" rows="8" aria-required="true"></textarea></div>',
            'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'Sie müssen <a href="%s">angemeldet sein</a>, um einen Kommentar abzugeben.', '_rrze' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Angemeldet als <a href="%1$s">%2$s</a>. <a href="%3$s" title="Aus diesem account abmelden">Abmelden?</a>', '_rrze' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            'comment_notes_before' => '<p class="comment-notes">' . __( 'Ihre Email-Adresse wird nicht veröffentlicht.', '_rrze' ) . ( $req ? $required_text : '' ) . '</p>',
            'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'Sie können die folgenden <abbr title="HyperText-Markup-Language">HTML</abbr>-Tags benutzen: %s', '_rrze' ), '<code>' . allowed_tags() . '</code>' ) . '</p>',
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
            'title_reply'          => __( 'Kommentar hinterlassen', '_rrze' ),
            'title_reply_to'       => __( 'Kommentar an %s hinterlassen', '_rrze' ),
            'cancel_reply_link'    => __( 'Abbrechen', '_rrze' ),
            'label_submit'         => __( 'Kommentar verfassen', '_rrze' ),
        );

        $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

        if ( comments_open( $post_id ) ) : ?>
            <?php do_action( 'comment_form_before' ); ?>
            <div id="respond" class="ym-noprint">
                <h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
                <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                    <?php echo $args['must_log_in']; ?>
                    <?php do_action( 'comment_form_must_log_in_after' ); ?>
                <?php else : ?>
                    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="ym-form ym-full">
                        <?php do_action( 'comment_form_top' ); ?>
                        <?php if ( is_user_logged_in() ) : ?>
                            <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                            <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                        <?php else : ?>
                            <?php echo $args['comment_notes_before']; ?>
                            <?php
                            do_action( 'comment_form_before_fields' );
                            foreach ( (array) $args['fields'] as $name => $field ) {
                                echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                            }
                            do_action( 'comment_form_after_fields' );
                            ?>
                        <?php endif; ?>
                        <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                        <?php echo $args['comment_notes_after']; ?>
                        <div class="form-submit ym-fbox-button">
                            <input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
                            <?php comment_id_fields( $post_id ); ?>
                        </div>
                        <?php do_action( 'comment_form', $post_id ); ?>
                    </form>
                <?php endif; ?>
            </div>
            <?php do_action( 'comment_form_after' );
        else :
            do_action( 'comment_form_comments_closed' );
        endif;
    }

}