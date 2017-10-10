<?php

/**
 * This is the model for singular posts.
 */
class Single extends MiddleModel {

    /**
     * This returns the current post
     *
     * @return array|null|WP_Post
     */
    public function post() {
        $post = \DustPress\Query::get_acf_post( get_the_ID() );
        return $post;
    }

    /**
     *  Return strings for localization.
     *
     * @return array
     */
    public function l10n() {
        $strings = array(
            'ilove' => __( 'I love this!', 'leijonaa' ),
            'likes' => __( 'likes', 'leijonaa' ),
            'comments' => __('comments', 'leijonaa' ),
        );
        return $strings;
    }

}