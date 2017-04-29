<div class="content">
    <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
            <ul class="main-navigation__list">
              <?php foreach ($project_list as $index => $project): ?>
                <li class="main-navigation__list-item <?=$_GET['project'] == $index ? 'main-navigation__list-item--active' : ''; ?>" >
                    <a class="main-navigation__list-item-link" href="http://doingsdone?project=<?=$index.'&term='.$_GET['term']; ?>"><?=$project; ?></a>
                    <span class="main-navigation__list-item-count"><?=tasks_cnt($tasks, $project);?></span>
                </li>
              <?php endforeach; ?>
            </ul>
        </nav>

        <a class="button button--transparent button--plus content__side-button" href="#">Добавить проект</a>
    </section>

    <main class="content__main">
        <h2 class="content__main-heading">Список задач</h2>

        <form class="search-form" action="index.php" method="post">
            <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

            <input class="search-form__submit" type="submit" name="" value="Искать">
        </form>

        <div class="tasks-controls">
            <nav class="tasks-switch">
                <?php foreach($terms as $index => $term): ?>
                    <a href="http://doingsdone<?='?project='.$_GET['project'].'&term='.$index; ?>" class="tasks-switch__item <?=$_GET['term'] == $index ? 'tasks-switch__item--active' : ''; ?>"><?=$term; ?></a> 
                <?php endforeach; ?>
            </nav>
            <label class="checkbox">
                <input id="show-complete-tasks" class="checkbox__input visually-hidden" type="checkbox" checked>
                <span class="checkbox__text">Показывать выполненные</span>
            </label>
        </div>

        <table class="tasks">
            <?php foreach ($tasks as $index => $task): ?>
                <?= date('d.m.Y'); ?>
                <?php if (!array_key_exists($_GET['term'], $terms) || !array_key_exists($_GET['project'], $project_list)): ?>
                    <?= header("HTTP/1.1 404 Not Found"); ?>
                <?php elseif ($project_list[$_GET['project']] == $task['project'] && ( ($_GET['term'] == 1 and $task['due_date'] == date('d.m.Y')) || ($_GET['term'] == 2 and $task['due_date'] == (date('d.m.Y') + 1)) || ($_GET['term'] == 3 and $task['due_date'] and $task['due_date'] < date('d.m.Y')) || ($_GET['term'] == 0) ) ): ?>
                    <tr class="tasks__item task <?=$task['realized'] ? 'task--completed' : '';?>">
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden" type="checkbox" <?=$task['realized'] ? 'checked' : '';?>>
                                <span class="checkbox__text"><?=$task['task'];?></span>
                            </label>
                        </td>
                        <td class="task__date"><?=$task['due_date'] ? $task['due_date'] : '';?></td>

                        <td class="task__controls">
                        </td>
                    </tr>
                <?php else: ?>
                    
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </main>
</div>