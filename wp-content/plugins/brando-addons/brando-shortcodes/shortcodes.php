<?php
class Brando_Require_Shortcode_Files {
    /*
     * Includes all (require_once) php file(s) inside selected folder using class.
     */
    public function __construct()
    {
        $this->Theme_Require_Shortcode_File( BRANDO_SHORTCODE_ADDONS_SHORTCODE_URI, array('row', 'inner-row', 'column','image-slider','accordion','progressbar','portfolio','button','feature-box','blog','section-heading','icons','icon-list','alert-massage','tab','tab-content','video-sound','counter','image-gallery','popup','content-block','coming-soon','team-member','image','text-block','blockquote','post-slider','separator','single-image-block','restaurant-menu','testimonial-slider','testimonial','timer','award-box','portfolio-filter'));
    }
    public function Theme_Require_Shortcode_File($path, $fileName)
    {

        if(is_array($fileName))
        {
            foreach($fileName as $name)
            {
                require_once($path.'/brando-'.$name.'.php');
            }
        }
        else
        {
            throw new Exception('File is not found in folder as you given');
        }
    }

}
$Brando_Require_Shortcode_Files = new Brando_Require_Shortcode_Files();
?>