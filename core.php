<?php

ini_set('display_errors', 1);
include 'mysql.php';
$db = new SafeMySQL();
$posts = json_decode(file_get_contents('https://api.vk.com/method/wall.get?owner_id=-99252033&count=30&filter=owner'));
print_r($posts);
for ($i = 1; $i <25; $i++) {
    if($i == 1){
        $toBase['is_pinned'] = 1;
    }else{
        $toBase['is_pinned'] = 0;
    }
    $toBase['text'] = substr($posts->response[$i]->text, 0, strpos($posts->response[$i]->text, ' ', 240));
    $toBase['img'] = $posts->response[$i]->attachment->photo->src_big;
    $toBase['link'] = 'wall-99252033_'.$posts->response[$i]->id;
    $toBase['reposts_count'] = $posts->response[$i]->reposts->count;
    $test = trim($toBase['text']);
    if(empty($test) or $posts->response[$i]->post_type == 'copy'){
        continue;
    }else{
        //если закреплённый пост не пуст(нет бана) удаляем старый
        if($i == 1){
            $db->query("DELETE FROM posts WHERE is_pinned = '1'");
        }
    }
    
    $is = $db->getRow("SELECT * FROM posts WHERE text = ?s OR img = ?s",$toBase['text'],$toBase['img']);
    if(!$is){
        $db->query("INSERT INTO posts SET ?u",$toBase);
    }
}

