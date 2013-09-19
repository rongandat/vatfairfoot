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
require_once(_PS_MODULE_DIR_ . "psblog/psblog.php");
require_once(_PS_MODULE_DIR_ . "psblog/classes/BlogPost.php");
require_once(_PS_MODULE_DIR_ . "psblog/classes/BlogCategory.php");
require_once(_PS_MODULE_DIR_ . "psblog/classes/BlogComment.php");

class PsblogPostsModuleFrontController extends ModuleFrontController {

    public $conf;
    public $id_category = null;
    public $id_post = null;
    public $list_link;

    public function __construct() {
        parent::__construct();
        $this->context = Context::getContext();
        $this->conf = Psblog::getPreferences();
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

        $this->list_link = BlogPost::linkList();
    }

    public function setMedia() {
        parent::setMedia();
        $this->addCSS($this->module->getPathUri() . 'psblog.css');
    }

    public function displayList() {

        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;

        $limit_per_page = intval($this->conf['list_limit_page']);
        $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? intval($_GET['p']) : 1;
        $start = ($current_page - 1) * $limit_per_page;

        $category = null;
        if (!is_null($this->id_category) && is_numeric($this->id_category)) {

            $category = new BlogCategory(intval($this->id_category));
            $category_lang = $category->id_lang;

            if ($category_lang != 0 && $category_lang != $id_lang || !$category->isAssociatedToShop($id_shop))
                $category->active = 0;
        }

        if ($category && $category->active) {

            $nb_articles = $category->nbPosts(true, true);

            // first page if page not exists
            $max_page = ceil($nb_articles / $limit_per_page);
            if ($max_page < $current_page) {
                $current_page = 1;
                $start = 0;
            }
            $list = $category->getPosts(true, true, $start, intval($this->conf['list_limit_page']));

            /* Metas */
            $curr_meta_title = $this->context->smarty->getTemplateVars('meta_title');
            $this->context->smarty->assign(array('meta_title' => $curr_meta_title . ' - ' . $category->name,
                'meta_description' => $category->meta_description,
                'meta_keywords' => $category->meta_keywords));

            $categoryLink = BlogCategory::linkCategory($category->id, $category->link_rewrite, $category->id_lang);
            $paginationLink = BlogCategory::linkCategory($category->id, $category->link_rewrite, $category->id_lang, '');

            $this->context->smarty->assign(array('categoryLink' => $categoryLink,
                'post_category' => $category,
                'paginationLink' => $paginationLink));
        } elseif ($category && $category->active == 0) {

            $this->context->smarty->assign('post_category', false);
            $this->context->smarty->assign('notfound', true);
        } else {

            if (isset($_GET['search']) && $_GET['search'] != '') {
                //search articles
                $search_query = $_GET['search'];

                $nb_articles = BlogPost::searchPosts($search_query, true, true, true);
                $list = BlogPost::searchPosts($search_query, true, true, false, $start, $limit_per_page);

                $this->context->smarty->assign('search_query_nb', $nb_articles);
                $this->context->smarty->assign('search_query', $search_query);

                $paginationLink = BlogPost::linkList('', null, $search_query);

                $this->context->smarty->assign('paginationLink', $paginationLink);
            } else {

                $paginationLink = BlogPost::linkList('');
                /*                 * * ALL ARTICLES ** */
                $nb_articles = BlogPost::listPosts(true, true, null, null, true, null, null, null);
                $list = BlogPost::listPosts(true, true, $start, $limit_per_page, false, null, null, null);
                $this->context->smarty->assign('paginationLink', $paginationLink);
            }
        }

        if (isset($list) && is_array($list) && count($list)) {

            /** pagination * */
            $nb_pages = ceil($nb_articles / $limit_per_page);

            $next = $current_page > 1 ? true : false; //articles plus recents
            $back = $current_page >= 1 && ($current_page < $nb_pages) ? true : false; //articles precedents

            $i = 0;
            foreach ($list as $val) {
                $list[$i]['link'] = BlogPost::linkPost($val['id_blog_post'], $val['link_rewrite'], $val['id_lang']);

                $categories = BlogCategory::getPostCategories($val['id_blog_post'], true, true);
                if ($categories) {
                    $j = 0;
                    foreach ($categories as $cat) {
                        $categories[$j]['link'] = BlogCategory::linkCategory($cat['id_blog_category'], $cat['link_rewrite'], $cat['id_lang']);
                        $j++;
                    }
                }

                $list[$i]['categories'] = $categories;
                $i++;
            }

            $this->context->smarty->assign(array(
                'post_list' => $list,
                'next' => $next,
                'back' => $back,
                'curr_page' => $current_page
            ));
        }

        $this->setTemplate('list.tpl');
    }

    public function displayPost() {

        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;

        if (is_null($this->id_post) || !is_numeric($this->id_post)) {
            return $this->displayList();
        }

        $post = new BlogPost($this->id_post);

        if ($post->status == 'published' && $post->isAssociatedToShop($id_shop)) {

            //comment submit 
            if (Tools::isSubmit('submitMessage') && $this->conf['comment_active'] && $post->allow_comments) {
                $comment = new BlogComment();

                try {

                    $message = trim(strip_tags(Tools::getValue('blog_comment')));

                    $comment->id_blog_post = $this->id_post;
                    $comment->customer_name = pSQL(Tools::getValue('customer_name'));

                    if ($message == '' || strlen($comment->customer_name) < (int) $this->conf['comment_name_min_length'])
                        Throw new Exception('error_input');

                    if (!Validate::isMessage($message) || !Validate::isGenericName($comment->customer_name))
                        Throw new Exception('error_input_invalid');

                    $comment->content = $message;

                    $id_customer = (int) $this->context->customer->id;
                    $id_guest = (int) $this->context->cookie->id_guest;

                    if (!$this->conf['comment_guest'] && empty($id_customer))
                        Throw new Exception('error_guest');

                    //get last comment from customer
                    $customerComment = BlogComment::getByCustomer($this->id_post, $id_customer, true, $id_guest);

                    $comment->id_customer = $id_customer;
                    $comment->id_guest = $id_guest;
                    $comment->id_lang = $id_lang;
                    $comment->id_shop = $id_shop;

                    if ($customerComment['content'] == $comment->content)
                        Throw new Exception('error_already');

                    if ($customerComment && (strtotime($customerComment['date_add']) + (int) $this->conf['comment_min_time']) > time())
                        Throw new Exception('error_delay');

                    $comment->active = ($this->conf['comment_moderate']) ? 0 : 1;
                    $comment->save();

                    $this->context->smarty->assign('psblog_confirmation', true);
                } catch (Exception $e) {

                    $comment->content = Tools::getValue('blog_comment');
                    $comment->customer_name = Tools::getValue('customer_name');

                    $this->context->smarty->assign('psblog_error', $e->getMessage());
                    $this->context->smarty->assign('comment', $comment);
                }
            }

            /*             * * view article ** */
            $images = $post->getImages(false);
            $categories = $post->listCategories(true);
            $products = $post->getProducts(true);
            $related = $post->listRelated(true, true);

            if (is_array($related) && count($related) > 0) {
                $i = 0;
                foreach ($related as $val) {
                    $related[$i]['link'] = BlogPost::linkPost($val['id_blog_post'], $val['link_rewrite'], $val['id_lang']);
                    $i++;
                }
            }

            if (is_array($products) && count($products) > 0) {
                $i = 0;
                foreach ($products as $p) {
                    $product = new Product($p['id_product'], false, $id_lang);
                    $products[$i]['link'] = $this->context->link->getProductLink($product);
                    $products[$i]['imageLink'] = $this->context->link->getImageLink($p['link_rewrite'], $p['id_product'] . '-' . $p['id_image'], $this->conf['product_img_format']);
                    $i++;
                }
            }

            /* SEO metas */
            $curr_meta_title = $this->context->smarty->getTemplateVars('meta_title');
            $this->context->smarty->assign(array('meta_title' => $curr_meta_title . ' - ' . $post->title,
                'meta_description' => $post->meta_description,
                'meta_keywords' => $post->meta_keywords));

            if ($this->conf['view_display_popin'] == 1) {
                $this->addjqueryPlugin('fancybox');
                $this->addJS($this->module->getPathUri() . 'js/popin.js');
            }

            if ($categories) {
                $i = 0;
                foreach ($categories as $cat) {
                    $categories[$i]['link'] = BlogCategory::linkCategory($cat['id_blog_category'], $cat['link_rewrite'], $cat['id_lang']);
                    $i++;
                }
            }

            $comments = $post->getComments();

            $this->context->smarty->assign(array(
                'post_images' => $images,
                'post_products' => $products,
                'post_related' => $related,
                'post_categories' => $categories,
                'post_comments' => $comments
            ));
        } else {
            $post->status = 'suspended';
        }

        $this->context->smarty->assign('post', $post);
        $this->setTemplate('view.tpl');
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
