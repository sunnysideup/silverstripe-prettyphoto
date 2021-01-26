<?php

namespace Sunnysideup\PrettyPhoto;

use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Extensible;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\View\Requirements;

class PrettyPhoto
{
    use Configurable;
    use Extensible;
    use Injectable;

    private static $themes = ['dark_rounded', 'dark_square', 'facebook', 'light_rounded', 'light_square'];

    private static $theme = '';

    private static $more_config = ['social_tools' => false];

    private static $selector = 'body';

    public static function include_code()
    {
        if (Director::is_ajax()) {
            self::block();
        } else {
            Requirements::javascript('silverstripe/admin: thirdparty/jquery/jquery.js');
            Requirements::javascript('sunnysideup/prettyphoto: client/javascript/jquery.prettyPhoto.js');
            Requirements::themedCSS('client/css/prettyPhoto');

            $config = '';
            $theme = Config::inst()->get(PrettyPhoto::class, 'theme');
            $moreConfigArray = Config::inst()->get(PrettyPhoto::class, 'more_config');
            foreach ($moreConfigArray as $key => $value) {
                if ($value === false) {
                    $value = 'false';
                } elseif ($value === true) {
                    $value = 'true';
                } elseif ($value === intval($value)) {
                    //$value = $value;
                } else {
                    $value = " '${value}' ";
                }
                $moreConfigArray[$key] = "${key}: ${value}";
            }
            if ($theme) {
                $config .= "theme: '" . $theme . "'";
            }
            if ($config && count($moreConfigArray)) {
                $config .= ', ';
            }
            if (count($moreConfigArray)) {
                $config .= implode(',', $moreConfigArray);
            }
            Requirements::customScript('PrettyPhotoInitConfigs = {' . $config . '}; jQuery(document).ready(function(){PrettyPhotoLoader.load("' . Config::inst()->get(PrettyPhoto::class, 'selector') . '")});', 'prettyPhotoCustomScript');
        }
    }

    public static function block()
    {
        Requirements::block('prettyphoto/javascript/jquery.prettyPhoto.js');
        Requirements::block('prettyphoto/css/prettyPhoto.css');
        Requirements::block('prettyPhotoCustomScript');
    }
}
