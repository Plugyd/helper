<?php

namespace Core;

use PDO;

class Store
{
    public static $DB = null;
    public static $Handle = null;
    public static $Query = '';

	private static $Instance = null;

	private $Host = 'localhost';
	private $User = 'root';
	private $Pass = '';
	private $Name = 'helper';

    private function __clone() {}

    private function __wakeup() {}

    private function __construct()
	{
		$Charset = 'UTF8';
		$Dsn = "mysql:host=$this->Host;dbname=$this->Name;charset=$Charset";

		$Options = [
    		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];

		 self::$DB = new PDO($Dsn, $this->User, $this->Pass, $Options);
	}


	public static function Init()
	{
		if (null === self::$Instance)
		{
			self::$Instance = new self();
		}
		return self::$Instance;
	}


	public static function GetAll($Query, $Param = array())
    {
        self::$Handle = self::$DB->prepare($Query);
        empty($Param)? self::$Handle->execute(): self::$Handle->execute((array) $Param);
        return self::$Handle->fetchAll();
    }

	public static function GetRow($Query, $Param = array())
    {
        self::$Handle = self::$DB->prepare($Query);
        empty($Param)? self::$Handle->execute(): self::$Handle->execute((array) $Param);
        return self::$Handle->fetch();
    }


	public static function GetColumn($Query, $Param = array())
    {
        self::$Handle = self::$DB->prepare($Query);
       empty($Param)? self::$Handle->execute(): self::$Handle->execute((array) $Param);
        return self::$Handle->fetchAll(PDO::FETCH_COLUMN);
    }


	public static function Prepare($Query)
    {
        return self::$Handle = self::$DB->prepare($Query);
    }

	public static function Execute( $Param = array())
    {
		return empty($Param)? self::$Handle->execute(): self::$Handle->execute((array) $Param);
    }

	public static function RowCount()
    {
        return self::$Handle->rowCount();
    }


	public static function LastInsertId()
    {
        return self::$DB->lastInsertId();
    }


	public static function Query()
    {
        return self::$DB->query();
    }

	public static function Fetch()
    {
        return self::$Handle->fetch();
    }

	public static function FetchAll()
    {
        return self::$Handle->fetchAll();
    }

	public static function BindValue($Num,$Attr,$Param = PDO::PARAM_STR)
    {
        return self::$Handle->bindValue($Num, $Attr,  $Param);
    }


}

?>
