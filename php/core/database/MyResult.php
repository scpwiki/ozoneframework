<?php



use __construct;
use result;
use __destruct;
use mysql_free_result;
use nextRow;
use mysql_fetch_array;
use resetPosition;
use asObjects;
use setNew;
use false;
use getSize;

/**
 * MySQL database query result.
 *
 */
class MyResult implements DatabaseResult{

	private $result;

	public function __construct($mysql_result) {
		$this->result = $mysql_result;
	}

	public function __destruct() {
		if (!$this->result)
			mysql_free_result($this->result);
	}

	public function nextRow() {
		return mysql_fetch_array($this->result);
	}

	public function resetPosition() {

	}

	public function asObjects($className) {
		$out = array();
		while($line = mysql_fetch_array($this->result)){
			$obj = new $className($line);
			$obj->setNew(false);
			$out[] = $obj;
		}
		return $out;
	}

	public function getSize(){

	}

}
