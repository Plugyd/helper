<?php
    spl_autoload_register(function ($Class) {
        include  'class/' .  str_replace('\\', '/', $Class) . '.php';
    });
    use Core\Store;
    Core\Store::Init();
    Store::Prepare('SELECT * FROM listing WHERE 
    ((descr LIKE ?)  OR (types LIKE ?)  OR (titles LIKE ?) OR (code LIKE ?)  OR (tags LIKE ?) ) ORDER BY id DESC LIMIT ?, ? ');
    Store::BindValue(1,'%'.$_POST['query'].'%', PDO::PARAM_STR);
    Store::BindValue(2,'%'.$_POST['query'].'%', PDO::PARAM_STR);
    Store::BindValue(3,'%'.$_POST['query'].'%', PDO::PARAM_STR);
    Store::BindValue(4,'%'.$_POST['query'].'%', PDO::PARAM_STR);
    Store::BindValue(5,'%'.$_POST['query'].'%', PDO::PARAM_STR);
		Store::BindValue(6,$_POST['start'], PDO::PARAM_INT);
		Store::BindValue(7,$_POST['limit'], PDO::PARAM_INT);
    Store::Execute();
    $Counts = Store::RowCount();
    $Data = Store::FetchAll();
    ?>

<div class="listing_res">Результаты: <?=$Counts?> </div>

<? foreach ($Data as $Listing) :?>
<? $Tags = explode(",", $Listing['tags']); ?>
  <div class="listing" id="listing<?=$Listing['id']?>">
  <div class="type"><span><?=strtoupper($Listing['types'])?></span> </div>
  <div class="copy" onclick="CopyToClipboard('#copy<?=$Listing['id']?>')">Копировать код</div>
  <div class="listing_name"><?=$Listing['titles']?></div>
  <div class="listing_desc"><?=$Listing['descr']?></div>
  <div class="listing_tags">
    <?foreach ($Tags as $Span){echo "<span>#".$Span."</span>";}?>
  </div>
  <div class="body-listing">
    <pre><code class="language-<?=$Listing['types']?>"><?=$Listing['code']?></code></pre>
    <textarea class="textcopy autosizes" code="<?=$Listing['id']?>"
      id="copy<?=$Listing['id']?>"> <?=$Listing['code']?> </textarea>
  </div>
</div>
<? endforeach;?>