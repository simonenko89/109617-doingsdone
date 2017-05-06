<div class="modal">
    <button class="modal__close" type="button" name="button">Закрыть</button>

    <h2 class="modal__heading">Добавление задачи</h2>

    <form class="form" class="" action=<?=(!isset($_POST['name']) == 0 || !isset($_POST['project']) == 0 || !isset($_POST['date']) == 0) ? 'index.php?add' : 'index.php'; ?> method="post" enctype="multipart/form-data">

        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <?=!isset($_POST['name']) ? '<br><span>Заполните это поле</span>' : '';?>
            <input class="form__input <?=!isset($_POST['name']) ? 'form__input--error' : ''; ?>" type="text" name="name" id="name" value="<?=isset($_POST['name']) ? $_POST['name'] : ''; ?>" placeholder="Введите название">
        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>
            <?=!isset($_POST['project']) ? '<br><span>Заполните это поле</span>' : '';?>
            <select class="form__input form__input--select <?=!isset($_POST['project']) ? 'form__input--error' : ''; ?>" name="project" id="project">
                <?php foreach ($project_list as $project): ?>
                <option value="<?=$project;?>" <?=isset($_POST['project']) && $_POST['project'] == $project ? 'selected' : '';?> ><?=$project;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения <sup>*</sup></label>
            <?=!isset($_POST['date']) ? '<br><span>Заполните это поле</span>' : '';?>
            <input class="form__input form__input--date <?=!isset($_POST['date']) ? 'form__input--error' : ''; ?>" type="text" name="date" id="date" value="<?=isset($_POST['date']) ? $_POST['date'] : ''; ?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
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