<?php
include 'functions.php';

$days = rand(0, 3);
$task_deadline_ts = strtotime("+" . $days . " day"); 
$current_ts = time();
$date_deadline = date("d.m.Y", $task_deadline_ts);
$days_until_deadline = floor(($task_deadline_ts - $current_ts) / 86400);

$project_list = ["Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];
$tasks = [
    [
        'task' => 'Собеседование в IT компании',
        'due_date' => "01.06.2017",
        'project' => 'Работа',
        'realized' => false
    ],
    [
        'task' => 'Выполнить тестовое задание',
        'due_date' => "25.05.2017",
        'project' => 'Работа',
        'realized' => false
    ],
    [
        'task' => 'Сделать задание первого раздела',
        'due_date' => "21.04.2017",
        'project' => 'Учеба',
        'realized' => true
    ],
    [
        'task' => 'Встреча с другом',
        'due_date' => "22.04.2017",
        'project' => 'Входящие',
        'realized' => false
    ],
    [
        'task' => 'Купить корм для кота',
        'due_date' => null,
        'project' => 'Домашние дела',
        'realized' => false
    ],
    [
        'task' => 'Заказать пиццу',
        'due_date' => null,
        'project' => 'Домашние дела',
        'realized' => false
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Дела в Порядке!</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body><!--class="overlay"-->
<h1 class="visually-hidden">Дела в порядке</h1>
    <?=include_template('templates/header.php'); ?>
<div class="page-wrapper">
    <div class="container container--with-sidebar">
        <?=include_template('templates/main.php', ['project_list' => $project_list, 'tasks' => $tasks, 'days_until_deadline' => $days_until_deadline, 'date_deadline' => $date_deadline]); ?>
    </div>
</div>
<?=include_template('templates/footer.php'); ?>
    
<div class="modal" hidden>
    <button class="modal__close" type="button" name="button">Закрыть</button>

    <h2 class="modal__heading">Добавление задачи</h2>

    <form class="form" class="" action="index.html" method="post">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input" type="text" name="name" id="name" value="" placeholder="Введите название">
        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select" name="project" id="project">
                <option value="">Входящие</option>
            </select>
        </div>

        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения <sup>*</sup></label>

            <input class="form__input form__input--date" type="text" name="date" id="date" value="" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
        </div>

        <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="preview" id="preview" value="">

                <label class="button button--transparent" for="preview">
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
</div>

<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
