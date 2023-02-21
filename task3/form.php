<form action="" method="POST">

  Имя:<input name="name" /><br>

  Email:<input name="email" /><br>

  Год:<select name="year">
    <?php 
    for ($i = 1922; $i <= 2022; $i++) {
      printf('<option value="%d">%d год</option>', $i, $i);
    }
    ?>
  </select><br>

  Пол:<input type="radio" name="sex" value="male" checked>
    <label>
      Мужчина
    </label>
  <input type="radio" name="sex" value="female">
    <label>
      Женщина
    </label><br>

  Конечностей:<input type="radio" name="limbs" value="3">
    <label>
      3
    </label>
  <input type="radio" name="limbs" value="4" checked>
    <label>
      4
    </label><br>

  Биография:<textarea name="biography"></textarea><br>

  <input type="submit" value="ok" />

</form>
