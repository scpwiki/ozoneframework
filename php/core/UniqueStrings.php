<?php



use DB\UniqueStringBrokerPeer;

/**
 * Utility class for providing unique strings.
 *
 */
class UniqueStrings {
 	private static $tr_lastTime;
 	private static $tr_lastTimeIssuedNumber = 0;

 	/**
 	 * Returns time-based + int element string.
 	 */
 	public static function timeBased(){
 		$timePart = time().'';
 		// TRANSACTION OR TABLE LOCK SHOULD START HERE
 		$db = Database::connection();
 		$db->begin();
 		$c = new Criteria();
 		$c->setForUpdate(true);
 		$index = UniqueStringBrokerPeer::instance()->selectOne($c);
 		if($index != null){
 			$idx = $index->getLastIndex();
 			$number = $idx + 1;
 			//update index + 1
 			UniqueStringBrokerPeer::instance()->increaseIndex();
 		} else {
 			$number = 0;
 			UniqueStringBrokerPeer::instance()->init();
 		}
 		$db->commit();
 		// TRANSACTION OR TABLE LOCK SHOULD END HERE
 		return $timePart."_".$number;
 	}

 	public static function resetCounter(){
 		UniqueStringBrokerPeer::instance()->reset();
 	}
 }
