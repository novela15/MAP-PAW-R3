<?php

function format_text_title($value) {
    return ucwords(strtolower(trim($value)));
}

function format_text_sentence($value) {
    $value = trim($value);
    if (empty($value)) return '';
    
    return ucfirst($value);
}

function sanitize_text_input($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function limit_text($text, $limit = 30) {
    $text = trim($text);
    if (strlen($text) > $limit) {
        return substr($text, 0, $limit) . '...';
    }
    return $text;
}
