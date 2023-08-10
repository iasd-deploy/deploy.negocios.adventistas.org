<?php 

class PA_Enqueue_Files {
	public function __construct(){
		add_action('wp_enqueue_scripts', [$this, 'RegisterChildAssets']);
	}

	public function RegisterChildAssets() {
		wp_enqueue_style( 'pa-child-style', get_stylesheet_uri());
	}
}
new PA_Enqueue_Files();