<div class="modal">
    <button class="modal__close" type="button" name="button">Закрыть</button>

    <h2 class="modal__heading">Добавление задачи</h2>

    <form class="form" class="" action="index.php" method="post">
        <?php if (strlen($_POST['name']) == 0 || !isset($_POST['name'])): ?>
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <?="<span class="."form__error".">Заполните это поле</span>"; ?>
            <input class="form__input <?="form__input--error"; ?>" type="text" name="name" id="name" value="" placeholder="Введите название">
        </div>
        <?php endif; ?>
        
        <?php if (strlen($_POST['project']) == 0 || !isset($_POST['project'])): ?>
        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>
            <?="<span class="."form__error".">Заполните это поле</span>"; ?>
            <select class="form__input form__input--select <?="form__input--error"; ?>" name="project" id="project">
                <?php foreach ($project_list as $project): ?>
                <option value=""><?=$project; ?></option>
                <?php endforeach; ?>
            </select>        
        </div>
        <?php endif; ?>
        
        <?php if (strlen($_POST['date']) == 0 || !isset($_POST['date'])): ?>
        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения <sup>*</sup></label>
            <?="<span class="."form__error".">Заполните это поле</span>"; ?>
            <input class="form__input form__input--date <?="form__input--error"; ?>" type="text" name="date" id="date" value="" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
        </div>
        <?php endif; ?>

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