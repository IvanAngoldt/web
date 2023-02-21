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

  Конечности:<input type="radio" id="limbChoice1" name="limb" value="3" checked>
    <label for="limbChoice1">
      3
    </label>
  <input type="radio" id="limbChoice2" name="limb" value="4">
    <label for="sexChoice2">
      4
    </label>  
  <input type="submit" value="ok" />
</form>
