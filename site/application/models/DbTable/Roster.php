<?php
/**
 * Roster
 *  
 * @author Jefferson
 * @version 
 */
require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Roster extends Zend_Db_Table_Abstract
{
    CONST UNIQUE_ID_LENGTH = 6;
    
    protected $_name = 'roster';
    
    protected $_attr_cols = array('strength', 'speed', 'agility');
    
    /**
     * Check for roster records for the given where parameters
     *
     * @param  array $params 
     * @return bool
     */
    public function checkDuplicateByParams($params) {
        $row = $this->fetchRow($params);
    
        if ($row)
        {
            return true;
        }
    
        return false;
    }
    
    /**
     * Generated series of alphanumberic characters
     *
     * 
     * @return string
     */
    protected function _generateUniquePlayerId() {
        return strtoupper(bin2hex(openssl_random_pseudo_bytes(self::UNIQUE_ID_LENGTH /2)));
    }
    
    /**
     * Generates random values for attributes scores. 
     * Function ensures that total attribute score will not exceed 100
     *
     * @param  init $min
     * @param  int $max
     * @return array
     */
    protected function _generateRandomAttributeScores($min = 5, $max = 60) {
        $data = array();
    	$loopMin = $min;
    	$loopMax = $max;
    	$iIdx = 0;
    	
    	while ($iIdx < count($this->_attr_cols)) { 
    		$result = 0;
    		if ($loopMax > 0) {
    			$result = ROUND(($loopMin+lcg_value()*(abs($loopMax-$loopMin))), 2);
    			
    			if($result >= $loopMax)
    			    $result = $result - $min;
    			
    			if ($result < $loopMax)
    				$loopMax = $loopMax - $result;
    			else
    				$loopMax = 0;
    		} else {
    		    $result = ROUND((($min /2) + lcg_value()*(abs($min - ($min /2)))), 2);
    		}
    		
    		$data[ $this->_attr_cols[$iIdx] ] = $result;
    		$iIdx++;
    	}
    	
    	// fail safe, just in case attributes exceeds 100
    	$tot = array_sum($data);
    	if ($tot > 100) {
    	   foreach($data as $fld => $val) {    
    	       if ($val > 15) {
    	           $data[$fld] = $val /2;
    	           // exit loop if sum is already less than 100
    	           if (array_sum($data) < 100)
    	               break;
    	       }   
    	   }
    	}
    	
    	$data['totalatrscr'] = array_sum($data);
    	return $data;
    }
    
    /**
     * Generates team members, create unique id and player names 
     * 
     *
     * @param  init $teamId
     * @param  int $rosterCnt
     * @param  int $startCnt
     * @return array
     */
    public function autoGenerateTeamRoster($teamId, $rosterCnt, $startCnt) {
        
        try {
            for($iCtr =1; $iCtr <= $rosterCnt; $iCtr++) {
                $data = array();
                $data['teamid'] = $teamId;
                $data['playerid'] = $this->_generateUniquePlayerId();
                $data = array_merge($data, $this->_generateRandomAttributeScores());
                $data['firstname'] = 'Player ' . $teamId . substr($data['playerid'], 0, 3);
                $data['lastname'] = 'Bot Last' . substr($data['playerid'], 3, 3);
                
                if ($iCtr <= $startCnt)
                    $data['starter'] = 'Y';
                else
                    $data['starter'] = 'N';
                
                $this->addRecord($data);
            }
        } catch (Exception $e) {
            throw($e);
        }
    }
    
    /**
     * Return list of team members based on the given team id
     *
     *
     * @param  int $teamId
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchRosterByTeam($teamId) {
        return $this->fetchAll(array('teamid = ?' => $teamId));
    }
    
    /**
     * Create roster record
     *
     *
     * @param  array $data
     * @return mixed
     */
    public function addRecord($data)
    {
        return $this->insert($data);
    }
    
    /**
     * Update roster record 
     * 
     *
     * @param  int $id
     * @param  array $data
     * @return int
     */
    public function updateRecord($id, $data)
    {
        $id = (int)$id;
        return $this->update($data, 'id =' . $id);
    
    }
    
}

?>