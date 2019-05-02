<?php

  spl_autoload_register(function ($Class) {
    include  'class/' .  str_replace('\\', '/', $Class) . '.php';
    });

    use Core\Store;

    Core\Store::Init();

    Store::Prepare('SELECT id FROM listing WHERE id = ?');
		Store::BindValue(1, PDO::PARAM_INT);
		Store::Execute();
    $Data = Store::RowCount();
    
    var_dump($Data);
    
        ?>

 <!-- <div class="listing" id="l1">
     <div class="type"><span>PHP</span> </div>
     <div class="listing_name">CSS color</div>
     <div class="listing_desc">Изменить цвет</div>
     <div class="listing_tags"><span>css</span><span>color</span><span>php</span></div>
     <pre><code class="language-css"></code></pre>
 </div> -->