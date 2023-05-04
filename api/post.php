<?php

require "../config.php";

$type_request = strtolower($_SERVER['REQUEST_METHOD']);

if ($type_request === 'post') {

    $title = filter_input(INPUT_POST, 'title');
    $body = filter_input(INPUT_POST, 'body');

    if ($title && $body) {

        
        $sql = $pdo->prepare("INSERT INTO notes (title, body) VALUES  (:title, :body)");
        $sql->bindValue(':title', $title);
        $sql->bindValue(':body', $body);
        $sql->execute();

        $id = $pdo->lastInsertId();
       
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $id,
                'title' => $title,
                'body' => $body
            ];
       
    } else {
        $array['error'] = "Dados não enviados";
    }
} else {
    $array['error'] = 'Permitido apenas POST';
}

require "./return.php";
