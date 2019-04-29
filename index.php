<?
	set_error_handler('EHandler');

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
</head>

<body>

    <!-- Header -->
    <header>
        <div class="help_header_main"></div>
    </header>
    <!-- EndHeader -->

    <!-- Autocomplete -->
    <h2 class="help_h2">Autocomplete</h2>

    <div>
        <input id="autocomplete" title="type">
    </div>



    <!-- Footer -->

    <!-- Script -->
    <script src="js/jquery-3.4.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>