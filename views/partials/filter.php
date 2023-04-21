<div class="p-3">
    <h4 class="font-italic">Сортировка <a href="/crud?sort=<?= $sort?>&order=<?= $order == "desc" ? "asc" : "desc" ?>&start-date=<?= $date1 ?>&end-date=<?= $date2 ?>&keywords=<?= $keywords?>" id="order_btn">
            <button class="btn btn-primary mt-2 sort ml-2 "><?= strtoupper($order) ?></button></a></h4>
    <ol class="list-unstyled mb-0 sort">
        <li><a href="/crud?sort=id&order=<?= $order ?>&start-date=<?= $date1 ?>&end-date=<?= $date2 ?>&keywords=<?= $keywords?>" id="id">ID</a></li>
        <li><a href="/crud?sort=title&order=<?= $order ?>&start-date=<?= $date1 ?>&end-date=<?= $date2 ?>&keywords=<?= $keywords?>" id="title">Загаловок</a></li>
        <li><a href="/crud?sort=publication_date&order=<?= $order ?>&start-date=<?= $date1 ?>&end-date=<?= $date2 ?>&keywords=<?= $keywords?>" id="publication_date">Дата</a></li>
    </ol>
    <h4 class="font-italic">Фильтр</h4>
    <form id="crud-filter">
        <ol class="list-unstyled mb-0">
            <li><div><input type="date" name="start-date" id="start-date" value="<?= $date1 ?>"> Требуются оба значения</div></li>
            <li><div><input type="date" name="end-date" id="end-date" value="<?= $date2 ?>" ></div></li>
            <li>Введите ключевые слова через запятую</li>
            <li><div><input type="text" name="keywords" id="keywords" value="<?= $keywords ?>"></div></li>
            <input type="hidden" name="sort" id="sort" value="<?= $sort ?>">
            <input type="hidden" name="order" id="order" value="<?= $order ?>">
            <li><button class="btn btn-primary mt-2 sort">Сортировать</button></li>
            <li><a href="/crud" class="btn btn-primary mt-2">Сброс</a></li>
        </ol>
    </form>
</div>