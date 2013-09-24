<?php

class HelperFieldFormNew extends Helper {

    public static function displaySelectField($name, $option_values, $current_value, $title, $description = '', $options = array()) {

        $opt_defaults = array('class' => '', 'required' => false);
        $opt = array_merge($opt_defaults, $options);

        $content = '<label>' . $title . ' </label>
                                    <div class="margin-form">  
                                            <select name="' . $name . '" class="' . $opt['class'] . '">';

        foreach ($option_values as $option) {
            $value = $option['value'];
            $label = $option['title'];
            $content .= '<option id="' . $name . '_' . $value . '" value="' . $value . '" ' . ($value == $current_value ? 'selected' : '') . '> &nbsp; ' . $label . ' &nbsp; </option>';
        }

        $content .= '</select>';

        if ($opt['required'])
            $content .= " <sup>*</sup>";

        if (!is_null($description) && !empty($description)) {
            $content .= '<p class="preference_description">' . $description . '</p>';
        }

        $content .= '</div><div class="clear space"></div>';

        return $content;
    }

    public static function displayRadioField($name, $option_values, $current_value, $title, $description = '', $options = array()) {

        $opt_defaults = array('required' => false);
        $opt = array_merge($opt_defaults, $options);

        $content = '<label class="text">' . $title . ' </label>
                         <div class="margin-form">';
        foreach ($option_values as $option) {
            $value = $option['value'];
            $label = $option['title'];
            $content .= '<input id="' . $name . '_' . $value . '" type="radio" name="' . $name . '" value="' . $value . '" ' . ($value == $current_value ? 'checked="checked" ' : '') . '/><label class="t" for="' . $name . '_' . $value . '" class="radioCheck">' . $label . '</label> &nbsp; ';
        }

        if ($opt['required'])
            $content .= " <sup>*</sup>";

        if (!is_null($description) && !empty($description)) {
            $content .= '<p class="preference_description">' . $description . '</p>';
        }

        $content .= '</div><div class="clear"></div>';

        return $content;
    }

    public static function displayDateField($name, $value, $title, $description = '', $options = array()) {
        $opt_defaults = array('class' => '', 'required' => false);
        $opt = array_merge($opt_defaults, $options);

        $content = '<label> ' . $title . ' </label>
                                    <div class="margin-form">
                                       <input type="text" name="' . $name . '" value="' . $value . '" class="datepicker ' . $opt['class'] . '" />';

        if ($opt['required'])
            $content .= " <sup>*</sup>";

        if (!is_null($description) && !empty($description)) {
            $content .= '<p class="preference_description">' . $description . '</p>';
        }

        $content .= '</div>';

        return $content;
    }

    public static function displayTextField($name, $value, $type, $title, $description = '', $options = array()) {
        $opt_defaults = array('size' => 50,
            'cols' => 80,
            'id' => $type . '_' . $name,
            'rows' => 4,
            'class' => '',
            'required' => false,
            'tinymce' => false);

        $opt = array_merge($opt_defaults, $options);

        $content = '<label>' . $title . '</label>
				<div class="margin-form">';

        if ($type == 'text') {
            $content .= '<input size=' . $opt['size'] . ' class="' . $opt['class'] . '" id="' . $opt['id'] . '" type="text" name="' . $name . '" value="' . htmlentities($value, ENT_COMPAT, 'UTF-8') . '" />';
        } elseif ($type == 'textarea') {
            $content .= '<textarea cols=' . $opt['cols'] . ' rows=' . $opt['rows'] . ' class="' . $opt['class'] . ' ' . ($opt['tinymce'] == true ? 'rte autoload_rte' : '') . '" id="' . $opt['id'] . '" name="' . $name . '">' . htmlentities($value, ENT_COMPAT, 'UTF-8') . '</textarea>';
        }

        if ($opt['required'])
            $content .= " <sup>*</sup>";

        if (!is_null($description) && !empty($description)) {
            $content .= '<p class="preference_description">' . $description . '</p>';
        }

        $content .= '</div>';

        $content .= '<div class="clear"></div>';

        return $content;
    }

    public static function displayTextLangField($languages, $name, $value, $type, $title, $description = '', $options = array()) {
      
        $opt_defaults = array('size' => 50,
            'cols' => 80,
            'rows' => 4,
            'class' => '',
            'required' => false,
            'tinymce' => false);

        $opt = array_merge($opt_defaults, $options);

        $content = '<label>' . $title . '</label>
				<div class="margin-form">';

        $content .= '<div class="translatable">';

        if ($opt['required'])
            $content .= " <sup>*</sup>";

        foreach ($languages as $language) {
            $content .= '<div class="lang_' . $language['id_lang'] . '" style="display: ' . ($language['is_default'] ? 'block' : 'none') . '; float:left;">';

            if ($type == 'text') {
                $content .= '<input size=' . $opt['size'] . ' class="' . $opt['class'] . '" id="' . $name . '_' . $language['id_lang'] . '" type="text" name="' . $name . '_' . $language['id_lang'] . '" value="' . htmlentities($value, ENT_COMPAT, 'UTF-8') . '" style="float: left" />';
            } elseif ($type == 'textarea') {
                $content .= '<textarea cols=' . $opt['cols'] . ' rows=' . $opt['rows'] . ' class="' . $opt['class'] . ' ' . ($opt['tinymce'] == true ? 'rte autoload_rte' : '') . '" id="' . $name . '_' . $language['id_lang'] . '" name="' . $name . '_' . $language['id_lang'] . '" style="float:left">' . htmlentities($value, ENT_COMPAT, 'UTF-8') . '</textarea>';
            }

            $content .= '</div>';
        }

        $content .= '</div>';

        if (!is_null($description) && !empty($description)) {
            $content .= '<p class="preference_description">' . $description . '</p>';
        }

        $content .= '<div class="clear"></div>
                                </div>';

        return $content;
    }

}