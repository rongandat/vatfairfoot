<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(_PS_MODULE_DIR_ . 'myvideo/classes/VideoCategory.php');
require_once(_PS_MODULE_DIR_ . 'myvideo/classes/Videos.php');

class AdminVideoController extends ModuleAdminController {

    public function __construct() {
        $this->table = 'video';
        $this->className = 'Videos';
        $this->module = 'myvideo';

        $this->lang = true;
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));
        $this->fieldImageSettings = array(
            'name' => 'image',
            'dir' => 'myvideo'
        );

        $this->fields_list = array(
            'id_video' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 30),
            'youtube_id' => array('title' => $this->l('Youtube ID'), 'width' => 'auto'),           
            'title' => array('title' => $this->l('Title'), 'width' => 'auto'),
            'description' => array('title' => $this->l('Description'), 'width' => 500, 'maxlength' => 90, 'orderby' => false),
            'id_video_cat' => array('title' => $this->l('Video Cat ID'), 'width' => 'auto'),
            'position' => array('title' => $this->l('Position'), 'width' => 40, 'filter_key' => 'position', 'align' => 'center'),
            'active' => array(
                'title' => $this->l('Displayed'), 'width' => 25, 'active' => 'status',
                'align' => 'center', 'type' => 'bool', 'orderby' => false
        ));
        parent::__construct();
    }
    public function setMedia() {
        parent::setMedia();
        $this->addJqueryUi('ui.widget');
        $this->addJqueryPlugin('tagify');
    }

    public function renderForm() {
        $this->toolbar_btn['save-and-stay'] = array('href' => '#', 'desc' => $this->l('Save and stay'));
        $defaultLanguage = $this->default_form_language;

        $this->initToolbar();
        if (!$this->loadObject(true))
            return;

        $this->fields_form = array(
            'tinymce' => true,
            'legend' => array(
                'title' => $this->l('Video'),
                'image' => '../img/admin/tab-categories.gif'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Title:'),
                    'name' => 'title',
                    'required' => true,
                    'lang' => true,
                    'class' => 'copy2friendlyUrl',
                    'hint' => $this->l('Invalid characters:') . ' <>;=#{}'
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Description :'),
                    'name' => 'description',
                    'autoload_rte' => true,
                    'rows' => 10,
                    'cols' => 100,
                    'lang' => true,
                    'desc' => $this->l('Will be displayed in top of category page')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Video ID:'),
                    'name' => 'youtube_id',
                    'required' => true,
                    
                    'class' => 'copy2friendlyUrl',
                    'hint' => $this->l('This is the id of youtube video')
              ) ,
                array(
                    'type' => 'file',
                    'label' => $this->l('Image Cover:'),
                    'name' => 'image',
                    'required' => true,
                    'display_image' => true,                   
                ) 
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );

        $this->fields_form['input'][] = array(
            'type' => 'text',
            'label' => $this->l('Position :'),
            'size' => 3,
            'name' => 'position'
        );
        $categories = VideoCategory::listCategories($defaultLanguage);

        $this->fields_form['input'][] = array(
            'type' => 'select',
            'label' => $this->l('Category'),
            'desc' => $this->l('Choose a category'),
            'name' => 'id_video_cat',
            'required' => true,
            'options' => array(
                'query' => $categories,
                'id' => 'id_option',
                'name' => 'name'
            )
        );

        $this->fields_form['input'][] = array(
            'type' => 'radio',
            'label' => $this->l('Status :'),
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
        
        if (!($video = $this->loadObject(true)))
			return;
//        $image = ImageManager::thumbnail(_PS_MYVIDEO_IMG_DIR_.'/'.$video->id.'.jpg', $this->table.'_'.(int)$video->id.'.'.$this->imageType, 350, $this->imageType, true);
//		$this->fields_value = array(
//			'image' => $image ? $image : false,
//			'size' => $image ? filesize(_PS_MYVIDEO_IMG_DIR_.'/'.$video->id.'.jpg') / 1000 : false
//		);
        return parent::renderForm();
    }
    
    protected function afterImageUpload()
	{
		$res = true;

		/* Generate image with differents size */
		if (($id_video = (int)Tools::getValue('id_video')) &&
			isset($_FILES) &&
			isset($_FILES) && count($_FILES) && $_FILES['image']['name'] != null &&
			file_exists(_PS_MYVIDEO_IMG_DIR_.$id_video.'.jpg'))
		{
			$images_types = ImageType::getImagesTypes('products');
			foreach ($images_types as $k => $image_type)
			{
				$res &= ImageManager::resize(
					_PS_MYVIDEO_IMG_DIR_.$id_video.'.jpg',
					_PS_MYVIDEO_IMG_DIR_.$id_video.'-'.stripslashes($image_type['name']).'.jpg',
					(int)$image_type['width'],
					(int)$image_type['height']
				);
			}
		}

		if (!$res)
			$this->errors[] = Tools::displayError('Unable to resize one or more of your pictures.');

		return $res;
	}
}

?>
