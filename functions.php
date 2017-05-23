<?php

require_once 'mysql_helper.php';

function db_select($link, string $sql, array $data = []): array 
{
    $result = [];
    
    if ($link == false) {
        $result = ["Ошибка подключения: " . mysqli_connect_error()];
    }
    
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    
    return $stmt;    
}


function db_insert(mixed $link, string $sql, array $data = []): mixed
{
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    
    $query_result = mysqli_query($link, $stmt);
    
    if ($query_result == false) {
       $result = false; 
        
    } else {
        
        $result = mysqli_insert_id($link);
    }
    
    return $result;    
}


function db_update(mixed $link, string $table_name, array $update_data = [], array $where_data = []): mixed
{
    $sql_update = '';
    $sql_where ='';
    
    foreach ($update_data as $key => $value) {
        $sql_update .= "$key = $value";
    }
    $sql_update = substr($sql_update, 0, length($sql_update)-2);
    
    foreach ($where_data as $key => $value) {
        $sql_where .= "$key = $value";
    }
    $sql_where = substr($sql_where, 0, length($sql_where)-2);
    
    if (length($sql_update) == 0) {
        $result = false;
    } else if (length($sql_update) > 0 and length($sql_where) == 0){
        $sql = "update $table_name set $sql_update";
    } else {
        $sql = "update $table_name set $sql_update where $sql_where";
    }
    
    $stmt = db_get_prepare_stmt($link, $sql, $update_data);
    
    $query_result = mysqli_query($link, $stmt);
    
    if ($query_result == false) {
       $result = false; 
        
    } else {
        
        $result = mysqli_affected_rows($link);
    }
    
    return $result; 
}



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
    $new_task = [];
    foreach ($tasks as $task) {
        if ($task['project'] == $project) {
            array_push($new_task, $task);
        }   
    }

    return $new_task;
}

function arrayDelRealizedTask(array $tasks): array
{
    foreach ($tasks as $index => $task) {
        if ($task['realized']) {
            unset($tasks[$index]);
        }   
    }
    return $tasks;
}

function searchUserByEmail($email, $users)
{
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return $user;
        }
    }
    
    return null;
}