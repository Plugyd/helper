<?
	set_error_handler('EHandler');
    define('SITE_PATH',$_SERVER["DOCUMENT_ROOT"]);
	function EHandler($ErrorNum, $ErrorMsg, $FileName, $LineError) 
	{
	  $Date = date('Y-m-d H:i:s (T)');
	  $File = fopen(SITE_PATH . '/tmp/errors.log', 'a');

	  if (!empty($File)) 
	  {
	    $FileName = str_replace(SITE_PATH,'',$FileName);
	    $ErrorLog = " Times: $Date\r\nError: $ErrorMsg ($ErrorNum) in $FileName in line $LineError\r\n\r\n";
	    fwrite($File, $ErrorLog);
	    fclose($File);
	  }
    }
    
  
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Помощник - Helper</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/prism.css">
</head>

<body>

    <!-- Header -->
    <header>
        <div class="help_header_main">
            <div class="help_header_main-all">
                <div class="help_header_name">Helper</div>

                <div class="help_header_search">
                    <p class="help_h2">Autocomplete</p>
                    <input id="autocomplete" title="type">
                    <div class="search" name="search">Поиск</div>
                </div>
            </div>
        </div>
    </header>
    <!-- EndHeader -->
    <main>
        <div class="help_main_main">

            <h2>Listings: 543</h2>
            <div class="help_main_main_all">
            </div>
        </div>
    </main>
    <!-- Autocomplete -->
    <?


//     use Core\Store;

// 		Store::Prepare('SELECT id FROM listing WHERE (tags = ?) ');
// 		Store::BindValue(1, $_POST['query'], PDO::PARAM_INT);
// 		Store::Execute();
// 		$Data = Store::RowCount();
// var_dump($Data);
  ?>

    <!-- Footer -->

    <!-- Script -->
    <script src="js/jquery-3.4.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/prism.js"></script>

</body>

</html>