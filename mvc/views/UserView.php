<?php
namespace mvc\views;

class UserView {
    public function render($template, $data = []) {
        extract($data);
        include __DIR__ . '/../views/template.php';
    }
}
