<?php

class TextHelper {
    public function formatTextTitle($value) {
        return ucwords(strtolower(trim($value)));
    }

    public function formatTextSentence($value) {
        $value = trim($value);
        if (empty($value)) return "";
    
        return ucfirst($value);
    }

    public function sanitizeTextInput($value) {
        return htmlspecialchars(trim($value), ENT_QUOTES, "UTF-8");
    }

    public function limitText($text, $limit = 30) {
        $text = trim($text);

        if (strlen($text) > $limit) {
            return substr($text, 0, $limit) . "...";
        }

        return $text;
    }
}
