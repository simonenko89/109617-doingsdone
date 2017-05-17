/*получить список из всех проектов для одного пользователя;*/
select * from projects as p join tasks as t on p.id = t.project_id where t.user_id = 1;

/*получить список из всех задач для одного проекта;*/
select * from tasks where project_id=3;

/*пометить задачу как выполненную;*/
update tasks set realized_dt = now() where id = 1;

/*добавить новый проект;*/
insert into projects set name = 'Личное';

/*добавить новую задачу (включает указание проекта, дату завершения, название);*/
insert into tasks (project_id, user_id, due_dt, name) values(5, 3, '2017-06-15 00:00:00', 'Поменять резину');

/*получить все задачи для завтрашнего дня;*/
select * from tasks where date(due_dt) = curdate() + interval 1 day;

/*обновить название задачи по её идентификатору*/
update tasks set name = 'Собеседование в банке' where id = 1;