<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
	return;
}
?>

<div class="post-comments background-lightest p-4 p-md-5">

    <div id="comments" class="comments-area">

        <?php
        if ( have_comments() ) :
            ?>
            <h4 class="comments-title">
                <?php
                $wst_comment_count = get_comments_number();
                if ( '1' === $wst_comment_count ) {
                    printf(
                        /* translators: 1: title. */
                        esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'wst' ),
                        '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                    );
                } else {
                    printf(
                        /* translators: 1: comment count number, 2: title. */
                        esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $wst_comment_count, 'comments title', 'wst' ) ),
                        number_format_i18n( $wst_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                    );
                }
                ?>
            </h4>

            <?php the_comments_navigation(); ?>

            <div class="comment-list">
                <?php
                wp_list_comments(
                    array(
                        'style'      => 'div',
                        'avatar_size' => 0,
                        'short_ping' => true,
                    )
                );
                ?>
            </div>

            <?php
            the_comments_navigation();

            if ( ! comments_open() ) :
                ?>
                <p class="no-comments"><?php _e( 'Comments are closed.', 'wst' ); ?></p>
                <?php
            endif;

        endif;

        comment_form();
        ?>

    </div>

</div>
