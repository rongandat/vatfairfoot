<?php

/**
 * Prestablog tab for admin panel
 * @category admin
 *
 * @author Appside 
 * @copyright Appside
 * @link appside.net
 * 
 */
require_once(_PS_MODULE_DIR_ . 'psblog/classes/BlogPost.php');
require_once(_PS_MODULE_DIR_ . 'psblog/classes/BlogComment.php');

class AdminBlogCommentsController extends ModuleAdminController {

    public function __construct() {
        $this->table = 'blog_comment';
        $this->className = 'BlogComment';

        $this->module = 'psblog';
        $this->multishop_context = Shop::CONTEXT_ALL;

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));

        $this->_select .= ' SUBSTRING(p.`title`,1,35) AS `post_title`, l.`iso_code`, s.`name` AS `shop_name` ';
        $this->_join .= ' LEFT JOIN ' . _DB_PREFIX_ . 'blog_post p on p.id_blog_post = a.id_blog_post ';
        $this->_join .= ' LEFT JOIN ' . _DB_PREFIX_ . 'lang l on l.id_lang = a.id_lang ';
        $this->_join .= ' LEFT JOIN ' . _DB_PREFIX_ . 'shop s on s.id_shop = a.id_shop ';

        $this->_orderBy = 'id_blog_comment';
        $this->_orderWay = 'DESC';

        $this->fields_list = array('id_blog_comment' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 30),
            'active' => array('title' => $this->l('Active'), 'active' => 'status', 'align' => 'center', 'type' => 'bool', 'orderby' => false, 'width' => 60),
            'post_title' => array('title' => $this->l('Post'), 'width' => 170),
            'shop_name' => array('title' => $this->l('Shop'), 'width' => 120, 'filter_key' => 's!shop_name'),
            'iso_code' => array('title' => $this->l('Lang'), 'width' => 20),
            'customer_name' => array('title' => $this->l('Customer'), 'width' => 70),
            'content' => array('title' => $this->l('Comment'), 'width' => 280),
            'date_add' => array('title' => $this->l('Date'), 'width' => 30));

        parent::__construct();
    }

    public function renderForm() {
        if (!($obj = $this->loadObject(true)))
            return;

        $post = new BlogPost($obj->id_blog_post);
        $obj->post_title = $post->title;

        if (!is_null($obj->id_customer) && !empty($obj->id_customer)) {
            $tokenCustomer = Tools::getAdminToken('AdminCustomers' . (int) (Tab::getIdFromClassName('AdminCustomers')) . (int) $this->context->employee->id);
            $linkCustomer = '?tab=AdminCustomers&id_customer=' . $obj->id_customer . '&viewcustomer&token=' . $tokenCustomer;

            $obj->customer_name_label = '<a href="' . $linkCustomer . '"><strong>' . $obj->customer_name . '</strong></a>';
        } else {

            $obj->customer_name_label = $obj->customer_name;
        }
        
       $iso = $this->context->language->getIsoById($obj->id_lang);
       $obj->iso_code = ($iso) ? $iso : '&nbsp;';
       
       $shop = $this->context->shop->getShop($obj->id_shop);
       $obj->shop_name = ($shop) ? $shop['name'] : '&nbsp;';
       
        $this->fields_form = array(
            'legend' => array('title' => '<img src="../img/admin/comment.gif"> ' . $this->l('Comment')),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );

        $this->fields_form['input'][] = array(
            'type' => 'text_label',
            'label' => $this->l('Date :'),
            'name' => 'date_add');
              
        $this->fields_form['input'][] = array(
            'type' => 'text_label',
            'label' => $this->l('Post title :'),
            'name' => 'post_title');

        $this->fields_form['input'][] = array(
            'type' => 'text_label',
            'label' => $this->l('Customer :'),
            'name' => 'customer_name_label');
        
       $this->fields_form['input'][] = array(
            'type' => 'text_label',
            'label' => $this->l('Shop :'),
            'name' => 'shop_name');
      
       $this->fields_form['input'][] = array(
            'type' => 'text_label',
            'label' => $this->l('Lang :'),
            'name' => 'iso_code');
           
        $this->fields_form['input'][] = array('type' => 'hidden', 'name' => 'customer_name');
        $this->fields_form['input'][] = array('type' => 'hidden', 'name' => 'id_blog_post');

        $this->fields_form['input'][] = array(
            'type' => 'textarea',
            'label' => $this->l('Message :'),
            'rows' => 4,
            'cols' => 92,
            'id' => 'comment_content',
            'name' => 'content');

        $this->fields_form['input'][] = array(
            'type' => 'radio',
            'label' => $this->l('Active :'),
            'name' => 'active',
            'required' => false,
            'class' => 't',
            'is_bool' => true,
            'values' => array(
                array(
                    'id' => 'active_on',
                    'value' => 1,
                    'label' => $this->l('Enabled')
                ),
                array(
                    'id' => 'active_off',
                    'value' => 0,
                    'label' => $this->l('Disabled')
                )
            )
        );

        $this->tpl_form_vars = array('comment' => $obj);

        return parent::renderForm();
    }

    public function initToolbar() {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

}

