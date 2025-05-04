<?php
require_once DIR . '/../helpers.php';

// Получаем данные из формы
$title = trim($_POST['title'] ?? '');
$category = trim($_POST['category'] ?? '');
$ingredients = trim($_POST['ingredients'] ?? '');
$description = trim($_POST['description'] ?? '');
$tags = $_POST['tags'] ?? [];
$steps = trim($_POST['steps'] ?? '');

// Простая валидация
$errors = [];

if ($title === '') {
    $errors['title'] = 'Название обязательно.';
}
if ($ingredients === '') {
    $errors['ingredients'] = 'Ингредиенты обязательны.';
}
if ($description === '') {
    $errors['description'] = 'Описание обязательно.';
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
    echo "<p><a href='../../public/recipe/create.php'>Назад</a></p>";
    exit;
}

// Сохраняем рецепт
$recipe = [
    'title' => htmlspecialchars($title),
    'category' => htmlspecialchars($category),
    'ingredients' => htmlspecialchars($ingredients),
    'description' => htmlspecialchars($description),
    'tags' => array_map('htmlspecialchars', $tags),
    'steps' => htmlspecialchars($steps),
    'created_at' => date('Y-m-d H:i:s')
];

file_put_contents(
    DIR . '/../../storage/recipes.txt',
    json_encode($recipe) . PHP_EOL,
    FILE_APPEND
);

// Перенаправляем на главную страницу
header('Location: ../../public/index.php');
exit;