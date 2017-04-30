<?php

function include_template(string $template, array $params = []): string
{
    if (!file_exists($template)) {
        return '';        
    }
    
    extract($params);
    
    ob_start();
    
    include $template;
    
    return ob_get_clean();
}

function xss(string $checked_value)
{
    return htmlspecialchars($checked_value);
}


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
}

function array_filtering(array $tasks, string $project): array
{
    foreach ($tasks as $task) {
        if ($task['project'] == $project) {
            $new_task = $task;
        }   
    }
    
    return $new_task;
}

?>