/*Заполняем таблицу projects*/
insert into projects set name = 'Входящие';
insert into projects set name = 'Учеба';
insert into projects set name = 'Работа';
insert into projects set name = 'Домашние дела';
insert into projects set name = 'Авто';

/*Заполняем таблицу users*/
insert into users set email = 'ignat.v@gmail.com', name = 'Игнат', pass_hash = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka';
insert into users set email = 'kitty_93@li.ru', name = 'Леночка', pass_hash = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa';
insert into users set email = 'warrior07@mail.ru', name = 'Руслан', pass_hash = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW';

/*Заполняем таблицу tasks*/
insert into tasks set project_id = 3, user_id = 1, name = 'Собеседование в IT компании', due_dt = '2017-05-16 21:45:51';
insert into tasks set project_id = 3, user_id = 2, name = 'Выполнить тестовое задание', due_dt = '2017-05-25 00:00:00';
insert into tasks set project_id = 2, user_id = 3, realized_dt = '2017-04-01 00:00:00', name = 'Сделать задание первого раздела', due_dt = '2017-04-21 00:00:00';
insert into tasks set project_id = 1, user_id = 1, name = 'Встреча с другом', due_dt = '2017-04-22 00:00:00';
insert into tasks set project_id = 4, user_id = 2, name = 'Купить корм для кота';
insert into tasks set project_id = 4, user_id = 3, name = 'Заказать пиццу';