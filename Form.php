<?php
// class/Form.php

class Form {
    public static function input($type, $name, $value = '', $placeholder = '') {
        $html = '<input type="' . htmlspecialchars($type) . '" ';
        $html .= 'name="' . htmlspecialchars($name) . '" ';
        $html .= 'value="' . htmlspecialchars($value) . '" ';
        $html .= 'placeholder="' . htmlspecialchars($placeholder) . '">';
        return $html;
    }
    
    // Anda bisa tambahkan method lain seperti validate(), select(), dll.
}
?>