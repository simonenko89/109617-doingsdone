<?php

function include_template(string $template, $template_param1, $template_param2)
{
    if ($template) {
        htmlspecialchars($template_param1);
        htmlspecialchars($template_param2);
        ob_start();
        include 'templates/'.$template;
        $k = ob_get_clean();
        return $k;
    } else {
        return '';
    }
}

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

function tasks_cnt(array $tasks, string $project): int 
{
    if ($project == "Все") {
        return count($tasks);
    }
    $count = 0;
    foreach ($tasks as $task) {
        if ($task['project'] == $project) {
            $count++;
        }   
    }
    return $count;
};

?>