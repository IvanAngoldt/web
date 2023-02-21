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

  Пол:<input type="radio" id="sexChoice1" name="sex" value="male" checked>
    <label for="sexChoice1">
      Мужчина
    </label>
  <input type="radio" id="sexChoice2" name="sex" value="female">
    <label for="sexChoice2">
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

  Биография<textarea id="biography" class="biography" name="biography" ></textarea>
  <input type="submit" value="ok" />
</form>
