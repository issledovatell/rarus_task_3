<?php
include '../index.php';

// сделан отдельный SQL-скрипт с тестовым набором данных
$query = "SELECT * FROM books
  LEFT JOIN authors
  ON authors.id = books.authors_id
";

//Делаем запрос к БД, результат запроса пишем в $result:
$result = mysqli_query($link, $query) or die( mysqli_error($link) );

//Преобразуем то, что отдала нам база в нормальный массив PHP $data:
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
?>

<div class="col-lg-7 mx-auto mt-5">
  <div class="alert alert-primary" style="text-align: center;">
    Все произведения из базы данных:
  </div>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col">Название книги</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Жанр</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $key => $value): ?>
        <tr>
          <td><?php echo $key + 1; ?></td>
          <td><?php echo $value['name']; ?></td>
          <td><?php echo $value['Имя']; ?></td>
          <td><?php echo $value['Фамилия']; ?></td>
          <td><?php echo $value['genre']; ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
