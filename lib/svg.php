<?php
namespace DustPress;

class Svg extends Helper {
    public function output() {
        if ( isset( $this->params->icon ) ) {
        	// Assets path
        	$asset_path = get_template_directory_uri() . '/assets/dist';
        	// Include icons
        	include_once( $_SERVER['DOCUMENT_ROOT'] . $asset_path . '/leijonaa-icons.svg' );
        	// Icon name
        	$icon = $this->params->icon;
        	// If class is set override this. Else keep it '';
        	$class = '';
        	if (isset ($this->params->class ) ) {
        		$class = $this->params->class;
        	}
        	// HTML for echoing.
        	$html = '<svg ' . $class . '>
  						<use xlink:href="'. $asset_path . '/leijonaa-icons.svg#' . $icon . '"></use>
					</svg>';
            return  $html;
            // If icon is not set, return error.
        } else {
        	$error = '<strong>Helper error: No icon defined</strong>';
        	return $error;
        }
    }
}

// Register helper.
dustpress()->add_helper( 'svg', new Svg() );