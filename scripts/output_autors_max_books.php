<?php
include '../index.php';

// сделан отдельный SQL-скрипт который выводит автора, который написал больше всего книг
$query = "SELECT MAX(authors_id) AS authors_id, COUNT(authors_id) AS count
  FROM	books
  GROUP BY authors_id
  HAVING COUNT(*) > 1
  ORDER BY count DESC
";

//Делаем запрос к БД, результат запроса пишем в $result:
$result = mysqli_query($link, $query) or die( mysqli_error($link) );

//Преобразуем то, что отдала нам база в нормальный массив PHP $data:
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

// Запишем в $authors_id значение authors_id таблицы books нулевого элемента массива $data.
// Т.к. запрос был сделан с сортировкой по убыванию и на месте нулевого элемента массива находится
// authors_id с наибольшим значением count
$authors_id = $data[0]['authors_id'];

$query1 = "SELECT Имя, Фамилия FROM authors
  JOIN books
  ON authors.id = $authors_id
  GROUP BY Фамилия
";

$result1 = mysqli_query($link, $query1) or die( mysqli_error($link) );

//Преобразуем то, что отдала нам база в нормальный массив PHP:
for ($data1 = []; $row = mysqli_fetch_assoc($result1); $data1[] = $row);
?>

<div class="list-group col-lg-5 mx-auto mt-5">
  <div class="alert alert-primary" style="text-align: center;">
    Имя автора(-ов) с наибольшим количеством книг в базе данных:
  </div>

  <?php foreach ($data1 as $key => $value): ?>
    <div class="alert alert-success" style="text-align: center;">
      <?php echo $value['Имя'] . ' ' . $value['Фамилия']; ?>
    </div>
  <?php endforeach ?>
</div>
