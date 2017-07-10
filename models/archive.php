<?php
/**
 * Class Archive
 */
class Archive extends MiddleModel {

    /**
     * Enable DustPress.js usage
     *
     * @var array
     */
    protected $api = [
        'Query'
    ];
    
    /**
     * Query posts for the archive page.
     * This function also handles pagination.
     *
     * @return array|bool|WP_Query
     */
    public function Query() {
        $args = $this->get_args();

        // Ajax requests set the page parameter.
        $page = isset( $args['page'] ) ? $args['page'] : 1;

        return $this->get_all_posts( $page );
    }
}
