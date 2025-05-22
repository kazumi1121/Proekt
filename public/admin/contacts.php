<?php
require_once '../../classes/Contact.php';
include '../../templates/header.php';

try {
    $contact = new Contact();
    $messages = $contact->readAll();
} catch (Exception $e) {
    echo "<p>Ошибка: " . htmlspecialchars($e->getMessage()) . "</p>";
    $messages = [];
}
?>

<h2>Сообщения с формы</h2>
<link rel="stylesheet" href="../../styles.css">
<table>
    <tr><th>Имя</th><th>Email</th><th>Сообщение</th><th>Дата</th></tr>
    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
        <tr>
            <td><?= htmlspecialchars($msg['name'] ?? 'Не указано') ?></td>
            <td><?= htmlspecialchars($msg['email'] ?? 'Не указано') ?></td>
            <td><?= nl2br(htmlspecialchars($msg['message'] ?? '')) ?></td>
            <td><?= htmlspecialchars($msg['created_at'] ?? 'Не указано') ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Нет сообщений для отображения.</td>
        </tr>
    <?php endif; ?>
</table>

<?php include '../../templates/footer.php'; ?>