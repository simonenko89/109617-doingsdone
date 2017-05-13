<?php

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

$users = [
    [
        'email' => 'ignat.v@gmail.com',
        'name' => 'Игнат',
        'password' => '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'
    ],
    [
        'email' => 'kitty_93@li.ru',
        'name' => 'Леночка',
        'password' => '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'
    ],
    [
        'email' => 'warrior07@mail.ru',
        'name' => 'Руслан',
        'password' => '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW'
    ]
];

if (isset($_POST['name']) && strlen($_POST['name']) > 0 && strlen($_POST['project']) > 0 && strlen($_POST['date']) > 0) {
    $new_task = [
        'task' => xss($_POST['name']),
        'due_date' => xss($_POST['date']),
        'project' => $_POST['project'],
        'realized' => false
    ];
    
    array_unshift($tasks, $new_task);
}

if (isset($_FILES['preview']) && is_uploaded_file($_FILES['preview']['tmp_name'])) {
    move_uploaded_file($_FILES['preview']['tmp_name'], __DIR__.'/'.$_FILES['preview']['name']);
}


$tasks_filter = [];
if (isset($_GET['project']) || (isset($_POST['send']) && !isset($_POST['name']))) {
    if (!array_key_exists($_GET['project'], $project_list)) {
        
    header("HTTP/1.1 404 Not Found");
    die("Страница не найдена");
        
    } else {
        $tasks_filter = array_filtering($tasks, $project_list[$_GET['project']]);
    }
    
} else {
    $tasks_filter = $tasks;
};


//Форма логина, проверки
$showLoginWin = false;

if (isset($_GET['login']) || isset($_POST['email']) || isset($_POST['password'])) {
    $showLoginWin = true;
}

$isValidEmail = true;
$email = '';

if (isset($_POST['email'])) {
    if (strlen($_POST['email']) == 0) {
        
        $isValidEmail = false;
        
    } else {
        
        $isValidEmail = true;
        $email = $_POST['email'];
        
    }
}

$isValidPass = (isset($_POST['password']) && strlen($_POST['password']) == 0) ? false : true;


$isWrongPass = false;
if (isset($_POST['password']) && isset($_POST['email'])) {
    
    $password = $_POST['password'];
    
    if ($user = searchUserByEmail($email, $users)) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            
            header("Location: /index.php");     
        } else {
            $isWrongPass = true;
        }
    }
}
$username = (isset($_SESSION['user'])) ? $_SESSION['user']['name'] : '';

//Работа с куками
if (isset($_GET['show_completed'])) {
    setcookie('show_completed', $_GET['show_completed'], strtotime("+30 days"));
    header("Location: /index.php");
}

$isChecked = false;
if ($_COOKIE['show_completed'] == 1) {
    $isChecked = true;
}

if (!$isChecked) {
    $tasks_filter = arrayDelRealizedTask($tasks_filter);
}