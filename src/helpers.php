<?php
/**
 * Экранирует вывод для защиты от XSS.
 *
 * @param string $text
 * @return string
 */
function h(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}