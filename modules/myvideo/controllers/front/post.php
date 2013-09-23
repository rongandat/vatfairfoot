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
require_once(_PS_MODULE_DIR_ . "myvideo/classes/VideoCategory.php");
define('_THEME_VIDEO_DIR_', _PS_IMG_ . 'myvideo/');

class MyvideoPostModuleFrontController extends ModuleFrontController {

    public $conf;
    public $id_category = null;
    public $id_post = null;
    public $list_link;
    public $table = 'video';

    public function __construct() {
        parent::__construct();
        $this->context = Context::getContext();
    }

    public function init() {
        Tools::switchLanguage(); //switch language if lang param, ps bug.

        /*         * * URL MANAGEMENT ** */

        if (isset($_GET['post']) && is_numeric($_GET['post'])) {
            $this->id_post = $_GET['post'];
        } elseif (isset($_GET['category']) && is_numeric($_GET['category'])) {
            $this->id_category = (int) $_GET['category'];
        }

        parent::init();

//        $this->list_link = Myvideo::linkList();
    }

    public function setMedia() {
        parent::setMedia();
        $this->addCSS($this->module->getPathUri() . 'myvideo.css');
    }

    public function displayList() {

        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;

        $limit_per_page = intval($this->conf['list_limit_page']);
        $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? intval($_GET['p']) : 1;
        $start = ($current_page - 1) * $limit_per_page;
        $list = VideoCategory::getCategories();
        $listCategories = array();
        if (isset($list) && is_array($list) && count($list)) {

            /** pagination * */
//            $nb_pages = ceil($nb_articles / $limit_per_page);
//            $next = $current_page > 1 ? true : false; //articles plus recents
//            $back = $current_page >= 1 && ($current_page < $nb_pages) ? true : false; //articles precedents

            $i = 0;
            foreach ($list as $cat) {

                $video = Videos::getVideoByCategory($cat['id_video_cat']);

                $cat['video'] = $video;
                $listCategories[] = $cat;
            }
//            echo '<pre>';
//            print_r($listCategories);
//            echo '</pre>';

            $this->context->smarty->assign(array(
                'list_categories' => $listCategories,
                'img_video_dir' => _THEME_VIDEO_DIR_
//                'next' => $next,
//                'back' => $back,
//                'curr_page' => $current_page
            ));
        }
        $this->setTemplate('list.tpl');
    }

    public function initContent() {
        parent::initContent();
        if (!is_null($this->id_post) && is_numeric($this->id_post)) {
            $this->displayPost();
        } else {
            $this->displayList();
        }

        $img_path = rtrim($this->conf['img_save_path'], '/') . '/';

        $this->context->smarty->assign(array('img_path' => _PS_BASE_URL_ . __PS_BASE_URI__ . $img_path,
            'blog_conf' => $this->conf,
            'logged' => $this->context->customer->isLogged(),
            'customerName' => ($this->context->customer->logged ? $this->context->customer->firstname : false),
            'listLink' => $this->list_link,
            'posts_rss_url' => BlogPost::linkRss()));

        // Assign template vars related to the category + execute hooks related to the category
        $this->assignCategory();
    }

    /**
     * Assign template vars related to category
     */
    protected function assignCategory() {
        $this->context->smarty->assign(array('HOOK_NEWS_FOOTER' => Hook::exec('displayFooterNews')));
    }

}
