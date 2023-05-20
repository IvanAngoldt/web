<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <title>Task 6</title>
    <link rel="stylesheet" href="db.css">
</head>
<body>
<?php
    echo '<div class="msgbox">'; 
        if (!empty($_COOKIE['updated'])) {
            echo '<p class="msg">Обновлены данные пользователя с id = ' . $_COOKIE['updated'] . '</p>';
            setcookie('updated', '', time() + 24 * 60 * 60);
        }
        if (!empty($_COOKIE['clear'])) {
            echo '<p class="msg">Удалены данные пользователя с id = ' . $_COOKIE['clear'] . '</p>';
            setcookie('clear', '', time() + 24 * 60 * 60);
        }
        if (!empty($messages)) {
            echo "<p>Данные пользователя с id = " . $_COOKIE['error_id'] . " не обновлены по следующим причинам:</br></p>";
            echo "<ol>";
            foreach ($messages as $message) {
                print('<li>' . $message . '</li>');
            }
            echo "<ol>";
        }
        echo '</div>';
    include('statistics.php');
    ?>
    <form action="" method="POST">
        <table>
            <caption>Данные формы</caption>
            <tr> 
                <th>id</th>
                <th>Имя</th>
                <th>email</th>
                <th>Год</th>
                <th>Пол</th>
                <th>Преобладающая рука</th>
                <th>Суперсила</th>
                <th>Биография</th>
                <th><a href="truncate.php"><img src="https://cdn-icons-png.flaticon.com/512/860/860829.png" width="25" height="25" alt="truncate"></a></th>
            </tr>
            <?php
                foreach ($values as $value) {
                    echo    '<tr>';
                    echo    '<td style="font-weight: 700;">'; print($value['application_id']); echo '</td>';
                    echo    '<td>
                                <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                    else print(" "); echo 'class="input" name="name'.$value['application_id'].'" value="'; print(htmlspecialchars(strip_tags($value['name']))); echo '">
                            </td>';
                    echo    '<td>
                                <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                    else print(" "); echo 'class="input" name="email'.$value['application_id'].'" value="'; print(htmlspecialchars(strip_tags($value['email']))); echo '">
                            </td>';
                    echo    '<td>';
                    echo        '<select'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                    else print(" "); echo 'name="year'.$value['application_id'].'">';
                                    for ($i = 2023; $i >= 1922; $i--) {
                                        if ($i == $value['year']) {
                                            printf('<option selected value="%d">%d год</option>', $i, $i);
                                        } else {
                                            printf('<option value="%d">%d год</option>', $i, $i);
                                        }
                                    }
                    echo        '</select>';
                    echo    '</td>';
                    echo    '<td> 
                                <div class="column-item">
                                    <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                        else print(" "); echo 'type="radio" id="radioMale'.$value['application_id'].'" name="sex'.$value['application_id'].'" value="male" ';
                                            if (htmlspecialchars(strip_tags($value['sex'])) == 'male') echo 'checked'; echo '>
                                    <label for="radioMale'.$value['application_id'].'">Мужчина</label>
                                </div>
                                <div class="column-item">
                                    <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                        else print(" "); echo 'type="radio" id="radioFemale'.$value['application_id'].'" name="sex'.$value['application_id'].'" value="female" ';
                                            if (htmlspecialchars(strip_tags($value['sex'])) == 'female') echo 'checked'; echo '>
                                    <label for="radioFemale'.$value['application_id'].'">Женщина</label>
                                </div>
                            </td>';
                    echo    '<td>
                                <div class="column-item">
                                    <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                        else print(" "); echo 'type="radio" id="radioRight'.$value['application_id'].'" name="hand'.$value['application_id'].'" value="right" ';
                                            if (htmlspecialchars(strip_tags($value['hand'])) == 'right') echo 'checked'; echo '>
                                    <label for="radioRight'.$value['application_id'].'">Правша</label>
                                </div>
                                <div class="column-item">
                                    <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                        else print(" "); echo 'type="radio" id="radioLeft'.$value['application_id'].'" name="hand'.$value['application_id'].'" value="left" ';
                                            if (htmlspecialchars(strip_tags($value['hand'])) == 'left') echo 'checked'; echo '>
                                    <label for="radioLeft'.$value['application_id'].'">Левша</label>
                                </div>
                            </td>';
                    $stmt = $db->prepare("SELECT superpower_id FROM abilities WHERE application_id = ?");
                    $stmt->execute([$value['application_id']]);
                    $abilities = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    echo    '<td class="abilities">
                                <div class="column-item">
                                    <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                        else print(" "); echo 'type="checkbox" id="god'.$value['application_id'].'" name="abilities'.$value['application_id'].'[]" value="1"' . (in_array(1, $abilities) ? ' checked' : '') . '>
                                    <label for="god'.$value['application_id'].'">бессмертие</label>
                                </div>
                                <div class="column-item">
                                    <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                        else print(" "); echo 'type="checkbox" id="noclip'.$value['application_id'].'" name="abilities'.$value['application_id'].'[]" value="2"' . (in_array(2, $abilities) ? ' checked' : '') . '>
                                    <label for="noclip'.$value['application_id'].'">прохождение сквозь стены</label>
                                </div>
                                <div class="column-item">
                                    <input'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                        else print(" "); echo 'type="checkbox" id="levitation'.$value['application_id'].'" name="abilities'.$value['application_id'].'[]" value="3"' . (in_array(3, $abilities) ? ' checked' : '') . '>
                                    <label for="levitation'.$value['application_id'].'">левитация</label>
                                </div>
                            </td>';
                    echo    '<td>
                                <textarea'; if(empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) print(" disabled ");
                                    else print(" "); echo 'name="biography'.$value['application_id'].'" id="" cols="30" rows="4" maxlength="128">';
                                        print htmlspecialchars(strip_tags($value['biography'])); echo '</textarea>
                            </td>';
                    echo    '<td>';
                if (empty($_COOKIE['edit']) || ($_COOKIE['edit'] != $value['application_id'])) {
                    echo        '<div class="column-item">
                                    <input name="edit'.$value['application_id'].'" type="image" src="https://static.thenounproject.com/png/2185844-200.png" width="25" height="25" alt="submit"/>
                                </div>
                                <div class="column-item">
                                    <input name="clear'.$value['application_id'].'" type="image" src="https://cdn-icons-png.flaticon.com/512/860/860829.png" width="25" height="25" alt="submit"/>
                                </div>';
                } else {
                    echo        '<div class="column-item">
                                    <input name="save'.$value['application_id'].'" type="image" src="https://cdn-icons-png.flaticon.com/512/84/84138.png" width="25" height="25" alt="submit"/>
                                </div>';
                }
                    echo    '</td>';
                    echo    '</tr>'; 
                }
            ?>
        </table>
        <?php if (!empty($_SESSION['login'])) {echo '<input type="hidden" name="token" value="' . $_SESSION["token"] . '">'; } ?>
    </form>
</body>
</html>
