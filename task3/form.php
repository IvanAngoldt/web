<form action="" method="POST">

  Имя:<input name="name" />

  Email:<input name="email" />

  Год:<select name="year">
    <?php 
    for ($i = 1922; $i <= 2022; $i++) {
      printf('<option value="%d">%d год</option>', $i, $i);
    }
    ?>
  </select>

  Пол:<input type="radio" name="sex" value="male" checked>
    <label>
      Мужчина
    </label>
  <input type="radio" name="sex" value="female">
    <label>
      Женщина
    </label>

  <input type="submit" value="ok" />
</form>
