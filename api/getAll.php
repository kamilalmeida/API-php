<?php
require "../config.php";

$type_request = strtolower($_SERVER['REQUEST_METHOD']);

if ($type_request === 'get') {
    $sql = $pdo->query("SELECT * FROM notes");

    if ($sql->rowCount() > 0) {

        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $item) {
            $array['result'][] = [
                'id' => $item['id'],
                'title' => $item['title'],
                'body' => $item['body']
            ];
        }
    }else{
        $array['error'] = 'ID nao encontrado';
    }
} else {
    $array['error'] = 'Permitido apenas GET';
}

require "./return.php";
