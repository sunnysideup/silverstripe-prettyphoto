<?php

class PrettyPhoto extends Object {

	private static $themes = array("dark_rounded", "dark_square", "facebook", "light_rounded", "light_square");

	private static $theme = "";

	private static $more_config = "social_tools: false";

	private static $selector = "body";

	public static function include_code() {
		if(Director::is_ajax()) {
			self::block();
		}
		else {
			Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
			Requirements::javascript('prettyphoto/javascript/jquery.prettyPhoto.js');
			Requirements::css('prettyphoto/css/prettyPhoto.css');

			$config = '';
			$theme = Config::inst()->get("PrettyPhoto", "theme");
			$moreConfig = Config::inst()->get("PrettyPhoto", "more_config");
			if($theme) {
				$config .= "theme: '".$theme."'";
			}
			if($config && $moreConfig) {
				$config .= ", ";
			}
			if($config) {
				$config .= $moreConfig;
			}
			Requirements::customScript('PrettyPhotoInitConfigs = {'.$config.'}; jQuery(document).ready(function(){PrettyPhotoLoader.load("'.self::$selector.'")});', "prettyPhotoCustomScript");
		}
	}

	public static function block() {
		Requirements::block('prettyphoto/javascript/jquery.prettyPhoto.js');
		Requirements::block('prettyphoto/css/prettyPhoto.css');
		Requirements::block("prettyPhotoCustomScript");
	}
}
