<html>

<head>
    <style>
        .error {
            border: 2px solid red;
        }
    </style>
</head>

<body>

    <?php
    if (!empty($messages)) {
        print('<div id="messages">');
        // Выводим все сообщения.
        foreach ($messages as $message) {
            print($message);
        }
        print('</div>');
    }
    ?>

    <form action="" method="POST">
        Имя: <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" /><br>
        email: <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>" /><br>
        <input type="submit" value="ok" />
    </form>
</body>

</html>