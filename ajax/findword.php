<?php
    spl_autoload_register(function ($Class) {
        include  'class/' .  str_replace('\\', '/', $Class) . '.php';
    });

    use Core\Store;
    Core\Store::Init();
    

    Store::Prepare('SELECT titles,descr,tags FROM listing WHERE ((titles LIKE ?) or (descr LIKE ?) or (tags LIKE ?)) ORDER BY id DESC LIMIT ?, ? ');
    Store::BindValue(1,'%'.$_POST['word'].'%', PDO::PARAM_STR);
    Store::BindValue(2,'%'.$_POST['word'].'%', PDO::PARAM_STR);
    Store::BindValue(3,'%'.$_POST['word'].'%', PDO::PARAM_STR);
    Store::BindValue(4,0, PDO::PARAM_STR);
    Store::BindValue(5,20, PDO::PARAM_STR);
    Store::Execute();
    $Data = Store::Fetch();

    echo json_encode($Data);

    ?>

