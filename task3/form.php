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

  Конечностей:<input type="radio" name="limbs" value="3" checked>
    <label>
      3
    </label>
  <input type="radio" name="limbs" value="4">
    <label>
      4
    </label>

  Биография:<textarea name="biography"></textarea>

  <input type="submit" value="ok" />

</form>
