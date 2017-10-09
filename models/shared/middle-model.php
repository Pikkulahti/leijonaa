<?php
/**
 * A middle model is used to wrap redundant data binding.
 */

/**
 * Class MiddleModel
 */
class MiddleModel extends \DustPress\Model {

    /**
     * Binds submodules for all extending classes.
     */
    public function Submodules() {
        $this->bind_sub( 'Header' );
        $this->bind_sub( 'Footer' );
    }


    /**
     * Fetches author data from options and stores it under MiddleModel class.
     */
    protected function get_author() {

        $author = array();

        // Check that acf is initialized.
        if ( function_exists('get_field') ) {

            // Get author name, image and email as array.
            $author_data = get_field( 'ljn_author-wrapper','option' );

            // Get author email from the array containing array.
            // The parent array can only have one item so we can use [0].
            $raw_email = $author_data[0]['ljn_author-email'];

            // If email is set, obfuscate it.
            $email = ! empty( $raw_email ) ? antispambot( $raw_email ) : '';

            // Restructure author data for view.
            $author = array(
                'intro'  => get_field( 'ljn_author-intro', 'option' ),
                'image'  => $author_data[0]['ljn_author-image'],
                'name'   => $author_data[0]['ljn_author-name'],
            );
            // Get author email.
            $raw_email = get_field( 'ljn_author-email', 'option' );
            // If email is set, obfuscate it.
            $email = ! empty( $raw_email ) ? antispambot( $raw_email ) : '';

            // Get author data from options.
            $author = array(
                'image'  => get_sub_field( 'ljn_author-image', 'option' ),
                'name'   => get_sub_field( 'ljn_author-name',  'option' ),
                'intro'  => get_field( 'ljn_author-intro', 'option' ),
                'email'  => $email,
            );
        }

        return $author;
    }

    /**
     * Fetches five newest posts and stores them under MiddleModel class.
     */
    protected function get_newest() {

        $args = [
            'post_type'                 => 'post',
            'posts_per_page'            => 5,
            'update_post_meta_cache'    => false,
            'update_post_term_cache'    => false,
            'no_found_rows'             => true,
            'query_object'              => false,
        ];

        $query = new WP_Query( $args );

        $newest = array();

        // If we have posts
        if ( isset( $query->posts ) ) {
            // Loop through posts and take needed data.
            foreach ( $query->posts as $post ) {
                $article = new stdClass();
                $article->permalink = get_permalink( $post->ID );
                $article->title = $post->post_title;
                $newest[] = $article;
            }

        }

        wp_reset_query();

        return $newest;
    }

    /**
     * Fetches monthly archives from last four years and stores them under MiddleModel class.
     */
    protected function get_archive() {
        $args = array(
            'type'            => 'monthly',
            'limit'           => '48',
            'format'          => 'custom',
            'show_post_count' => true,
            'echo'            => false,
            'order'           => 'DESC',
            'post_type'       => 'post',
        );

        $archive = wp_get_archives( $args );

        return $archive;
    }

    /**
     * Map and return sidebar data.
     */
    public function Sidebar() {

        $sidebar = array(
            'Author'  => $this->get_author(),
            //'Twitter' => $this->get_twitter(),
            'Newest'  => $this->get_newest(),
            'Archive' => $this->get_archive(),
        );

        return $sidebar;
    }

    /**
     * A wrapper function for querying posts from all categories.
     *
     * @param int $page     The page we are on.
     * @param int $per_page How many posts to query.
     *
     * @return array|bool|WP_Query
     */
    protected function get_all_posts( $page = 0, $per_page = 0 ) {

        if ( 0 === $per_page ) {
            // Get the default posts count for queries
            $per_page = (int) get_option( 'posts_per_page' );
        }

        if ( $page > 0 ) {
            // Set the offset.
            $offset = ( $page - 1 ) * $per_page;
        } else {
            $offset = 0;
        }

        $args = [
            'post_type'                 => 'post',
            'posts_per_page'            => $per_page,
            'offset'                    => $offset,
            'update_post_meta_cache'    => false,
            'update_post_term_cache'    => false,
            'no_found_rows'             => false,
            'query_object'              => true,
        ];

        // Use the Query class to get extended data for all posts.
        return \DustPress\Query::get_posts( $args );
    }
}