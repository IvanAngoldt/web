<form action="" method="POST">
  <input name="name" />
  <select name="year">
    <?php 
    for ($i = 1922; $i <= 2022; $i++) {
      printf('<option value="%d">%d год</option>', $i, $i);
    }
    ?>
  </select>
  <textarea id="biography" class="biography" name="biography" ></textarea>
  <input type="submit" value="ok" />
</form>
