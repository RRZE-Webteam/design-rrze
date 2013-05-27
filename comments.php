<?php if( post_password_required() ) : ?>
<div id="comments">
    <p class="nopassword">
        <?php _e( 'Dieser Eintrag ist passwortgeschützt. Um Kommentare anschauen zu können müssen Sie das Passwort angeben.', '_rrze' ); ?>
    </p>
</div>
<?php return; ?>
<?php endif; ?>
<div id="comments">
<?php if( have_comments() ) : ?>
    <h3 id="comments-title">
        <?php printf( _n( 'Ein Kommentar zu &ldquo;%2$s&rdquo;', '%1$s Kommentare zu &ldquo;%2$s&rdquo;', get_comments_number(), '_rrze' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'); ?>
    </h3>

    <ol class="commentlist">
        <?php wp_list_comments(); ?>
    </ol>

    <?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav id="nav-comments">
            <div class="ym-wbox">
                <h3 class="ym-skip"><?php _e( 'Kommentare-Navigation', '_rrze' ); ?></h3>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Ältere Kommentare', '_rrze' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Neuere Kommentare &rarr;', '_rrze' ) ); ?></div>
            </div>
        </nav>
    <?php endif; ?>

    <?php if( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="nocomments"><?php _e( 'Die Kommentarfunktion ist geschlossen.', '_rrze' ); ?></p>
    <?php endif; ?>
<?php endif; ?>
<?php Theme_Tags::comment_form(); ?>
</div>
