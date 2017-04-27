<?php

function include_template(string $template, array $params = []): string
{
    $filename = 'templates/'.$template.'.php';
    if (!file_exists($filename)) {
        return '';        
    }
    
    extract($params);
    
    ob_start();
    
    include $filename;
    
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
};

?>