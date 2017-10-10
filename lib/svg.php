<?php

namespace DustPress;

class Svg extends Helper {

    public function output() {
        if ( isset( $this->params->icon ) ) {
            if ( defined( 'SVG_SPRITE_NAME' ) ) {
                // Include icons
                $location = __DIR__ . '/../assets/images/';
                include_once( $location . SVG_SPRITE_NAME );
                // Icon name
                $icon = $this->params->icon;
                // If class is set override this. Else keep it empty;
                $class = '';
                if ( isset( $this->params->class ) ) {
                    $class = 'class="'. $this->params->class .'"';

                }
                // HTML for echoing.
                // Since screen-readers treat SVGs in many different ways we hide them. Please add information for screenreaders near the icon.
                $html = '<svg ' . $class . ' aria-hidden="true">
  						<use xlink:href="'. get_template_directory_uri() . '/assets/images/' . SVG_SPRITE_NAME . '#' . $icon . '"></use>
					</svg>';

                return $html;
            }
            // Path to sprite is not defined. Set error message accordincgly.
            else {
                $error = '<strong>Helper error: Path to sprite is not defined! Please define it via constant <i>PATH_TO_SVG_SPRITE</i></strong>';
            } // End inner if.
        }
        // Icon is not defined. Set error message accordingly.
        else {
            $error = '<strong>Helper error: No icon defined</strong>';
        } // End outer if.

        // If icon and path to sprite are not set, return error.
        return $error;
    }
}

// Register helper.
dustpress()->add_helper( 'svg', new Svg() );