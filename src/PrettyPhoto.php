<?php

namespace Sunnysideup\PrettyPhoto;

use ViewableData;
use Director;
use Requirements;
use Config;


class PrettyPhoto extends ViewableData/*
### @@@@ START UPGRADE REQUIRED @@@@ ###
FIND:  extends Object
NOTE: This used to extend Object, but object does not exist anymore. You can also manually add use Extensible, use Injectable, and use Configurable 
### @@@@ END UPGRADE REQUIRED @@@@ ###
*/
{
    private static $themes = array("dark_rounded", "dark_square", "facebook", "light_rounded", "light_square");

    private static $theme = "";

    private static $more_config = array("social_tools" =>  false);

    private static $selector = "body";

    public static function include_code()
    {
        if (Director::is_ajax()) {
            self::block();
        } else {
            Requirements::javascript('silverstripe/admin: thirdparty/jquery/jquery.js');
            Requirements::javascript('sunnysideup/prettyphoto: prettyphoto/javascript/jquery.prettyPhoto.js');
            Requirements::css('sunnysideup/prettyphoto: prettyphoto/css/prettyPhoto.css');

            $config = '';
            $theme = Config::inst()->get("PrettyPhoto", "theme");
            $moreConfigArray = Config::inst()->get("PrettyPhoto", "more_config");
            foreach ($moreConfigArray as $key => $value) {
                if ($value === false) {
                    $value = "false";
                } elseif ($value === true) {
                    $value = "true";
                } elseif ($value === intval($value)) {
                    //$value = $value;
                } else {
                    $value = " '$value' ";
                }
                $moreConfigArray[$key] = "$key: $value";
            }
            if ($theme) {
                $config .= "theme: '".$theme."'";
            }
            if ($config && count($moreConfigArray)) {
                $config .= ", ";
            }
            if (count($moreConfigArray)) {
                $config .= implode(",", $moreConfigArray);
            }
            Requirements::customScript('PrettyPhotoInitConfigs = {'.$config.'}; jQuery(document).ready(function(){PrettyPhotoLoader.load("'.Config::inst()->get("PrettyPhoto", "selector").'")});', "prettyPhotoCustomScript");
        }
    }

    public static function block()
    {
        Requirements::block('prettyphoto/javascript/jquery.prettyPhoto.js');
        Requirements::block('prettyphoto/css/prettyPhoto.css');
        Requirements::block("prettyPhotoCustomScript");
    }
}
