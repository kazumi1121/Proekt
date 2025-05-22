<?php
require_once __DIR__ . '/../classes/Contact.php';
include __DIR__ . '/../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        echo "<p>Все поля обязательны для заполнения.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Некорректный формат email.</p>";
    } else {
        try {
            $contact = new Contact();
            $contact->create($name, $email, $message);
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit;
        } catch (Exception $e) {
            echo "<p>Ошибка при отправке сообщения: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}

if (isset($_GET['success'])) {
    echo "<p>Сообщение отправлено!</p>";
}
?>

<h2>Свяжитесь с нами</h2>
<form method="POST">
    <label>Имя:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Сообщение:</label><br>
    <textarea name="message" rows="5" required></textarea><br><br>

    <button type="submit">Отправить</button>
</form>

<?php include __DIR__ . '/../templates/footer.php'; ?>