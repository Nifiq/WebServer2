<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=forms_db;charset=utf8mb4',
            'root',                    // ← лучше сменить на отдельного пользователя
            'Nifi753159Q*',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
            ]
        );
    } catch (PDOException $e) {
        http_response_code(500);
        die("Ошибка подключения к базе: " . $e->getMessage());
    }

    // Получение и очистка данных
    $name      = trim($_POST['name'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $birthdate = $_POST['birthdate'] ?? '';
    $gender    = $_POST['gender'] ?? '';
    $bio       = trim($_POST['bio'] ?? '');
    $contract  = isset($_POST['contract']) ? 1 : 0;
    $languages = $_POST['languages'] ?? [];

    // Валидация
    if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]{2,150}$/u", $name)) {
        die("Ошибка: некорректное ФИО");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Ошибка: некорректный email");
    }
    if (!in_array($gender, ['male', 'female'], true)) {
        die("Ошибка: неверный пол");
    }
    if (empty($languages) || !is_array($languages)) {
        die("Выберите хотя бы один язык");
    }

    try {
        $stmt = $db->prepare("INSERT INTO applications 
            (name, phone, email, birthdate, gender, bio, contract) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([$name, $phone, $email, $birthdate, $gender, $bio, $contract]);
        $app_id = $db->lastInsertId();

        $stmt2 = $db->prepare("INSERT INTO application_languages (application_id, language_id) VALUES (?, ?)");
        foreach ($languages as $lang) {
            $stmt2->execute([$app_id, (int)$lang]);   // приведение к int на всякий случай
        }

        echo "Данные успешно сохранены! ID заявки: " . $app_id;
    } catch (PDOException $e) {
        http_response_code(500);
        die("Ошибка при сохранении: " . $e->getMessage());
    }
} else {
    echo "Страница для отправки формы.";
}
?>