<?php
/**
 * Theme Require Files Class.
 *
 * @package Brando
 */
?>
<?php
class Brando_Require_Files_Class {
    /*
     * Includes all (require_once) php file(s) inside selected folder using class.
     */
    public function __construct()
    {
        
    }
    public static function Brando_Theme_Require_Files($brando_path, $brando_fileName)
    {

        if(is_array($brando_fileName))
        {
            foreach($brando_fileName as $name)
            {
                get_template_part( 'lib/'.$name );
            }
        }
        else
        {
            throw new Exception('File is not found in folder as you given');
        }
    }
}
$Brando_Require_Files_Class = new Brando_Require_Files_Class();

/*
 *  Includes all required files for brando Theme.
 */
Brando_Require_Files_Class::Brando_Theme_Require_Files( BRANDO_THEME_LIB,
    array(
        'brando-scripts',
        'brando-extra-function',
        'admin/admin_option',
        'brando-excerpt',
        'tgm/tgm-init',
        'menu-walker',
        'brando-breadcrumb',
    )
);