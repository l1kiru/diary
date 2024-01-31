<h1> Список дел </h1>
<form class="task-card task-card-creator" action="/add.php" method="post">
    <div>
        <span class="description"> Название задачи </span>
        <input type="text" name="name" id="name" placeholder="Начните писать..." class="input-field form-control">
    </div>
    <div>
        <span class="description"> Описание задачи </span>
        <textarea type="text" name="task" id="task" class="input-field form-control" rows="5"></textarea>
    </div>
    <div>
        <span class="description"> Временные рамки (необязательно) </span>
        <input type="date" name="task-limit-date" class="input-field form-control">
    </div>
        <button type="submit" class="btn btn-green btn-task-card-creator"> Отправить </button>
</form>