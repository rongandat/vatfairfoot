<?php

/**
 * Prestablog front controller
 * @category front
 *
 * @author Appside 
 * @copyright Appside
 * @link appside.net
 * 
 */
require_once(_PS_MODULE_DIR_ . "myphotos/myphotos.php");
require_once(_PS_MODULE_DIR_ . "myphotos/classes/Photos.php");
require_once(_PS_MODULE_DIR_ . "myphotos/classes/PhotosRatting.php");
require_once(_PS_MODULE_DIR_ . "myphotos/classes/PhotosCategory.php");
define('_THEME_PHOTO_DIR_', _PS_IMG_ . 'myphoto/');

class MyphotosRattingModuleFrontController extends ModuleFrontController {

    public $auth = false;
    public $conf;
    public $id_category = null;
    public $id_post = null;
    public $list_link;
    public $table = 'photo';
    
    public function __construct() {
        parent::__construct();
        $this->context = Context::getContext();

        $aResponse['error'] = false;
        $aResponse['message'] = '';

        if (isset($_POST['action'])) {
       
            $id_photo = $_POST['idBox'];
            $ratting = $_POST['rate'];
            if (PhotosRatting::checkRatting($id_photo)) {
                $photosRatting = new PhotosRatting();
                $photosRatting->add(array('id_photo' => $id_photo, 'ratting' => $ratting));
                $aResponse['error'] = FALSE;
                $aResponse['message'] = ('Your rate has been successfuly recorded. Thanks for your rate');
            } else {
                $aResponse['error'] = true;
                $aResponse['message'] = ('Your have rated for images');
                
                
            }
        } else {
            $aResponse['error'] = true;
            $aResponse['message'] = ('An error occured during the request. Please retry');
        }
        
        echo json_encode($aResponse);die;

    }

}
