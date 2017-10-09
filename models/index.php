<?php

/**
 * This is the default model class for our theme.
 */
class Index extends MiddleModel {
    /**
     * Fetch 10 most recent posts.
     *
     * @return WP_Query
     */
    public function Posts() {
        $args = array(
            'post_type'         => 'post',
            'post_visibility'   => 'published',
            'posts_per_page'    => 10,
        );
        // Get posts
        $posts = \DustPress\Query::get_acf_posts( $args );
        // If posts, modify and return them.
        if ( ! empty( $posts )  ) {
            // Add categories and tags under posts data.
            foreach ($posts as &$post) {
                // Post tags
                $post->tags = array();
                $tags = get_tags( $post->ID );
                // Loop through each tag and get tag name and link.
                foreach ($tags as $tag ) {
                    $post->tags[] = array(
                        'tag_name' => $tag->name,
                        'tag_link' => get_tag_link( $tag->ID ), 
                    );
                }
                // Post categories
                $post->categories = array();
                $categories = get_categories( $post->ID );
                // Loop through each category and get category name and link.
                foreach ($categories as $category ) {
                    $post->categories[] = array(
                        'category_name' => $category->name,
                        'category_link' => get_category_link( $category->ID ), 
                    );
                }
            }
            return $posts;
        } 
    }
}