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
require_once(_PS_MODULE_DIR_ . "psnews/psnews.php");
require_once(_PS_MODULE_DIR_ . "psnews/classes/News.php");

class PsNewsNewsModuleFrontController extends ModuleFrontController {

    public $conf;
    public $id_news = null;
    public $list_link;
    public $table = 'news';

    public function __construct() {
        parent::__construct();
        $this->context = Context::getContext();
        $this->conf = Psnews::getPreferences();
    }

    public function init() {
        Tools::switchLanguage(); //switch language if lang param, ps bug.

        /*         * * URL MANAGEMENT ** */

        if (isset($_GET['news']) && is_numeric($_GET['news'])) {
            $this->id_news = $_GET['news'];
        }

        parent::init();

        $this->list_link = News::linkList();
    }

    public function setMedia() {
        parent::setMedia();
//        $this->addCSS($this->module->getPathUri() . 'psblog.css');
    }

    public function displayList() {

        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;

        $limit_per_page = intval($this->conf['list_news_limit_page']);
        $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? intval($_GET['p']) : 1;
        $start = ($current_page - 1) * $limit_per_page;
        $list = News::listNews($start, $limit_per_page, true, 'n.position');

        $nb_articles = News::totalNews();

        // first page if page not exists
        $max_page = ceil($nb_articles / $limit_per_page);
        $next = $current_page > 1 ? true : false; //articles plus recents
        $back = $current_page >= 1 && ($current_page < $nb_pages) ? true : false; //articles precedents
        $this->context->smarty->assign(array(
            'news_list' => $list,
            'next' => $next,
            'back' => $back,
            'curr_page' => $current_page
        ));
        $this->setTemplate('list.tpl');
    }
    
    public function displayPost(){
        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;
        $news = new News($this->id_news,$id_lang);
       
        
        if ($news->active == '1') {

            /* SEO metas */
            $curr_meta_title = $this->context->smarty->getTemplateVars('meta_title');
            $this->context->smarty->assign(array(
                'meta_title' => $curr_meta_title . ' - ' . $news->meta_title,
                'meta_description' => $news->meta_description,
                'meta_keywords' => $news->meta_keywords));

            if ($this->conf['view_display_popin'] == 1) {
                $this->addjqueryPlugin('fancybox');
                $this->addJS($this->module->getPathUri() . 'js/popin.js');
            }

        } else {
            $news->status = 'suspended';
        }

        $this->context->smarty->assign('news', $news);
        $this->setTemplate('view.tpl');
    }

    public function initContent() {
        parent::initContent();
        if (!is_null($this->id_news) && is_numeric($this->id_news)) {
            $this->displayPost();
        } else {
            $this->displayList();
        }

        $this->context->smarty->assign(array(
            'img_path' => _THEME_NEWS_DIR_,
            'blog_conf' => $this->conf,
            'logged' => $this->context->customer->isLogged(),
            'customerName' => ($this->context->customer->logged ? $this->context->customer->firstname : false),
            'listLink' => $this->list_link,
            'newss_rss_url' => BlogPost::linkRss()));

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
