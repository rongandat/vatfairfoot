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
require_once(_PS_MODULE_DIR_ . "myvideo/myvideo.php");
require_once(_PS_MODULE_DIR_ . "myvideo/classes/Videos.php");
require_once(_PS_MODULE_DIR_ . "myvideo/classes/VideosRatting.php");
require_once(_PS_MODULE_DIR_ . "myvideo/classes/VideoCategory.php");
define('_THEME_VIDEO_DIR_', _PS_IMG_ . 'myvideo/');

class MyvideoRattingModuleFrontController extends ModuleFrontController {

    public $auth = false;
    public $conf;
    public $id_category = null;
    public $id_post = null;
    public $list_link;
    public $table = 'video';
    
    public function __construct() {
        parent::__construct();
        $this->context = Context::getContext();
        $aResponse['error'] = false;
        $aResponse['message'] = '';

        if (isset($_POST['action'])) {
       
            $id_video = $_POST['idBox'];
            $ratting = $_POST['rate'];
            if (VideosRatting::checkRatting($id_video)) {
                $videosRatting = new VideosRatting();
                $videosRatting->add(array('id_video' => $id_video, 'ratting' => $ratting));
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
