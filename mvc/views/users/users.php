<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список пользователей</title>
    <style> table { border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; } </style>
</head>
<body>
    <h1>Пользователи</h1>
    <?php if (empty($users)): ?>
        <p>Пользователи не найдены.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>ID</th><th>Имя</th><th>Email</th></tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>