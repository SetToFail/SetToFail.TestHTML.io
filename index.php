<?php
// Данные для базы знаний (можно заменить подключением к БД)
$topics = [
    1 => [
        'name' => 'Тема 1',
        'subtopics' => [
            1 => ['name' => 'Подтема 1.1', 'content' => 'Контент для подтемы 1.1'],
            2 => ['name' => 'Подтема 1.2', 'content' => 'Контент для подтемы 1.2']
        ]
    ],
    2 => [
        'name' => 'Тема 2',
        'subtopics' => [
            3 => ['name' => 'Подтема 2.1', 'content' => 'Контент для подтемы 2.1'],
            4 => ['name' => 'Подтема 2.2', 'content' => 'Контент для подтемы 2.2']
        ]
    ]
];

// Получаем выбранные тему и подтему из GET-параметров
$selectedTopicId = $_GET['topic'] ?? 1;
$selectedSubtopicId = $_GET['subtopic'] ?? array_key_first($topics[$selectedTopicId]['subtopics']);

// Выбранные данные
$selectedTopic = $topics[$selectedTopicId] ?? null;
$selectedSubtopic = $selectedTopic['subtopics'][$selectedSubtopicId] ?? null;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>База знаний</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>База знаний</h1>
             
        <div class="columns">
            <!-- Блок тем -->
            <div class="topics">
                <h2>Темы</h2>
                <ul>
                    <?php foreach ($topics as $id => $topic): ?>
                        <li class="<?= $id == $selectedTopicId ? 'active' : '' ?>">
                            <a href="?topic=<?= $id ?>"><?= htmlspecialchars($topic['name']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Блок подтем -->
            <div class="subtopics">
                <h2>Подтемы</h2>
                <?php if ($selectedTopic): ?>
                    <ul>
                        <?php foreach ($selectedTopic['subtopics'] as $id => $subtopic): ?>
                            <li class="<?= $id == $selectedSubtopicId ? 'active' : '' ?>">
                                <a href="?topic=<?= $selectedTopicId ?>&subtopic=<?= $id ?>">
                                    <?= htmlspecialchars($subtopic['name']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            
            <!-- Блок содержимого -->
            <div class="content">
                <h2>Содержимое</h2>
                <div class="content-box">
                    <?= $selectedSubtopic ? htmlspecialchars($selectedSubtopic['content']) : 'Выберите подтему' ?>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>