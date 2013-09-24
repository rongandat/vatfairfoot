<?php

define('_PS_MYPHOTO_IMG_DIR_', _PS_IMG_DIR_ . 'myphoto/');

class Link extends Link {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Create a link to a photo
     *
     * @param mixed $photo Photos object (can be an ID supplier, but deprecated)
     * @param string $alias
     * @param int $id_lang
     * @return string
     */
    public static function getPhotosLink($photo, $alias = null, $id_lang = null, $id_shop = null) {
        if (!$id_lang)
            $id_lang = Context::getContext()->language->id;

        if ($id_shop === null)
            $shop = Context::getContext()->shop;
        else
            $shop = new Shop($id_shop);
        $url = 'http://' . $shop->domain . $shop->getBaseURI() . $this->getLangLink($id_lang, null, $id_shop);

        $dispatcher = Dispatcher::getInstance();
        if (!is_object($photo)) {
            if ($alias !== null && !$dispatcher->hasKeyword('photo_rule', $id_lang, 'meta_keywords', $id_shop) && !$dispatcher->hasKeyword('photo_rule', $id_lang, 'meta_title', $id_shop))
                return $url . $dispatcher->createUrl('photo_rule', $id_lang, array('id' => (int) $photo, 'rewrite' => (string) $alias), $this->allow, '', $id_shop);
            $photo = new Photos($photo, $id_lang);
        }

        // Set available keywords
        $params = array();
        $params['id'] = $photo->id;
        $params['rewrite'] = (!$alias) ? $photo->link_rewrite : $alias;
        $params['meta_keywords'] = Tools::str2url($photo->meta_keywords);
        $params['meta_title'] = Tools::str2url($photo->meta_title);

        return $url . $dispatcher->createUrl('photo_rule', $id_lang, $params, $this->allow, '', $id_shop);
    }

}

?>
