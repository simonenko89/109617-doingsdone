<?php


error_reporting(E_ALL);

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

session_start();

$isWrongPass = true;
if (isset($_POST['password']) && isset($_POST['email'])) {
    
    $password = $_POST['password'];
    
    if ($user = searchUserByEmail($email, $users)) {

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            
            header("Location: /index.php");  
            
        } else {
            
            $isWrongPass = false;
            
        }
    }
}
$username = (!empty($_SESSION)) ? $_SESSION['user']['name'] : '';

?>

<?php if (!isset($_SESSION['user'])): ?>
    <?=include_template('templates/guest.php', ['showLoginWin' => $showLoginWin, 'isValidEmail' => $isValidEmail, 'isValidPass' => $isValidPass, 'email' => $email, 'isWrongPass' => $isWrongPass]); ?>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Дела в Порядке!</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <?php if (isset($_GET['add'])): ?>
    <body class=<?="overlay";?> >
    <?= include_template('form.php', ['project_list' => $project_list]); ?>
    <?php endif; ?>

        <h1 class="visually-hidden">Дела в порядке</h1>
        <?=include_template('templates/header.php', ['username' => $username]); ?>
        <div class="page-wrapper">
            <div class="container container--with-sidebar">
            <?=include_template('templates/main.php', ['project_list' => $project_list, 'tasks' => $tasks, 'days_until_deadline' => $days_until_deadline, 'date_deadline' => $date_deadline, 'tasks_filter' => $tasks_filter]); ?>
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
<?php endif; ?>