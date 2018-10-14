<?php
/**
 * Teams
 *  
 * @author Jefferson
 * @version 
 */
require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Teams extends Zend_Db_Table_Abstract
{
    protected $_name = 'teams';  
    
    /**
     * Fetch team record by id
     *
     * @param  int $id
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getRowById($id) {
        $id = (int)$id;
        return $this->fetchRow(array('id = ?' => $id));
    }
    
    /**
     * Check if there is an existing team record with the same team name
     *
     * @param  int $id
     * @param  string $name
     * @return bool
     */
    public function checkDuplicate($id, $name) {
        $row = $this->fetchRow(array("id <> ?" => $id, "name = ?" => $name));
        
        if ($row)
        {
            return true;
        }
        
        return false;
    }
    
    /**
     * Create team record
     *
     *
     * @param  string $name
     * @return mixed
     */
    public function addRecord($name)
    {
        $data = array(
            'name'  => $name
        );
        
        return $this->insert($data);
    }
    
    /**
     * Update team record
     *
     * @param  int $id
     * @param  string $name
     * @return int
     */
    public function updateRecord($id, $name)
    {
        $id = (int)$id;
        $data = array(
            'name'  => $name
        );
        
        return $this->update($data, 'id =' . $id);
    }
    
    /**
     * Delete team record
     *
     * @param  int $id
     * @return int
     */
    public function deleteRecord($id)
    {
        $id = (int)$id;
        return $this->delete(array('id = ?' => $id));
    }
}

?>