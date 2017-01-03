Pretty Photo================================================================================

Adds the jQuery Pretty Photo extension to your
Silverstripe Website.

SEE:
- http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
- http://jquery-plugins.net/prettyphoto-jquery-lightbox-clone


Developer
-----------------------------------------------
Nicolaas Francken [at] sunnysideup.co.nz


Requirements
-----------------------------------------------
see composer.json


Documentation
-----------------------------------------------
Please contact author for more details.

Any bug reports and/or feature requests will be
looked at in detail

We are also very happy to provide personalised support
for this module in exchange for a small donation.


Installation Instructions
-----------------------------------------------
1. add module as per usual

2. add the following stuff to controller class:

```php
class Page_Controller extends ContentController {

    function init(){
        parent::init();
        PrettyPhoto::include_code();
    }

}
```

OR TO REMOVE IT LIKE THIS:

class MyPageWithoutPrettyPhoto_Controller extends Page_Controller {

    function init(){
        parent::init();
        PrettyPhoto::block();
    }

}


3. in your templates, add (the rel="prettPhoto" is the magic part):

 <a href="mylargepicture.gif" rel="prettyPhoto"><img src="mysmallpicture.gif" /></a>

 OR FOR A SET OF PHOTOS:

 <a href="mylargepicture.gif" rel="prettyPhoto[gallery]"><img src="mysmallpicture.gif" /></a>
 <a href="mylargepicture.gif" rel="prettyPhoto[gallery]"><img src="mysmallpicture.gif" /></a>

4. Review configs and add entries to mysite/_config/config.yml
(or similar) as necessary.
In the _config/ folder of this module
you can usually find some examples of config options (if any).

Config Examples
------------------------------------------------

check http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
for more details.
