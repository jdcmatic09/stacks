<?php

require_once '../application/controllers/RequestHandler.php';

class RosterController extends Zend_Controller_Action
{
    use RequestHandler;
    
    const HTTP_AUTH_VALUE = 'Bearer XXXSTACKSPORTSXXX';
    CONST DEFAULT_ROSTER_COUNT = 15;
    CONST DEFAULT_STARTER_COUNT = 10;
    
    public function init()
    {
        /* Initialize action controller here */

    }
    
    /**
     * Action function that handles the roster display by team
     *
     * 
     * @return void
     */
    public function listAction()
    {
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            $teams = new Application_Model_DbTable_Teams();
            $this->view->team = $teams->getRowById($id);
            
            $roster = new Application_Model_DbTable_Roster();
            $this->view->roster = $roster->fetchRosterByTeam($id);
        }
    }
   
    /**
     * Controller function for Roster record edit request
     *
     * 
     * @return void
     */
   public function editAction()
    {
        if ($this->_initAJAXRequest() === true)
        {
            if ($this->getRequest()->isPut())
            {
                $requestData = Zend_Json_Decoder::decode($this->getRequest()->getRawBody());
                $roster = new Application_Model_DbTable_Roster();
                $data = array();
                $id = (int)$requestData['requestId'];
                $data['firstname'] = trim($requestData['firstName']);
                $data['lastname'] = trim($requestData['lastName']);
                if (strlen(trim($requestData['rating'])) > 0)
                    $data['rating'] = $requestData['rating'];
                
                $exist = $roster->checkDuplicateByParams(array("id <> ?" => $id,
                    "lower(firstname) = ?" => strtolower($data['firstname']),
                    "lower(lastname) = ?" => strtolower($data['lastname'])));
                if ($exist)
                {
                    $this->_helper->json(array('success' => -1, 'error' => 'Record with the same player name already exist: ' . $data['firstname'] . ' ' . $data['lastname']));
                }
                
                $result = $roster->updateRecord($id, $data);
                if (is_numeric($result)) {
                    $this->_helper->json(array('success' => $result, 'error' => ''));
                }
                $this->_helper->json(array('success' => -1, 'error' => $result));
            }
        }
    }
}

