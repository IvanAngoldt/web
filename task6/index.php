<?php

include('basic_auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $stmt = $db->prepare("SELECT application_id, name, email, year, sex, hand, biography FROM application");
        $stmt->execute();
        $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        exit();
    }
    if (!empty($_COOKIE['edit'])) {
        setcookie('edit', '', time() + 24 * 60 * 60);
    }
    include('errors.php');
    include('dbshow.php');
    exit();
} else {
    foreach ($_POST as $key => $value) {
        if (preg_match('/^clear(\d+)_x$/', $key, $matches)) {
            $app_id = $matches[1];
            setcookie('clear', $app_id, time() + 24 * 60 * 60);
            $stmt = $db->prepare("DELETE FROM application WHERE application_id = ?");
            $stmt->execute([$app_id]);
            $stmt = $db->prepare("DELETE FROM abilities WHERE application_id = ?");
            $stmt->execute([$app_id]);
            $stmt = $db->prepare("DELETE FROM users WHERE application_id = ?");
            $stmt->execute([$app_id]);
        }
        if (preg_match('/^edit(\d+)_x$/', $key, $matches)) {
            $app_id = $matches[1];
            setcookie('edit', $app_id, time() + 24 * 60 * 60);
        }
        if (preg_match('/^save(\d+)_x$/', $key, $matches)) {
            setcookie('edit', '', time() + 24 * 60 * 60);
            $app_id = $matches[1];
            include('errors.php');
            $stmt = $db->prepare("SELECT name, email, year, sex, hand, biography FROM application WHERE application_id = ?");
            $stmt->execute([$app_id]);
            $old_dates = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $db->prepare("SELECT superpower_id FROM abilities WHERE application_id = ?");
            $stmt->execute([$app_id]);
            $old_abilities = $stmt->fetchAll(PDO::FETCH_COLUMN);
            if (array_diff($dates, $old_dates[0])) {
                setcookie('updated', $app_id, time() + 24 * 60 * 60);
                $stmt = $db->prepare("UPDATE application SET name = ?, email = ?, year = ?, sex = ?, hand = ?, biography = ? WHERE application_id = ?");
                $stmt->execute([$dates['name'], $dates['email'], $dates['year'], $dates['sex'], $dates['hand'], $dates['biography'], $app_id]);
            }
            if (array_diff($abilities, $old_abilities) || count($abilities) != count($old_abilities)) {
                setcookie('updated', $app_id, time() + 24 * 60 * 60);
                $stmt = $db->prepare("DELETE FROM abilities WHERE application_id = ?");
                $stmt->execute([$app_id]);
                $stmt = $db->prepare("INSERT INTO abilities (application_id, superpower_id) VALUES (?, ?)");
                foreach ($abilities as $superpower_id) {
                    $stmt->execute([$app_id, $superpower_id]);
                }
            }
        }
    }
    header('Location: index.php');
}