<?php

require_once '../application/controllers/RequestHandler.php';

class TeamController extends Zend_Controller_Action
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
     * Controller function for listing all Team records
     *
     * 
     * @return void
     */
    public function listAction()
    {
        $form = new Application_Form_Main();
        $this->view->form = $form;
        
        // action body
        $teams = new Application_Model_DbTable_Teams();
        $this->view->teams = $teams->fetchAll();
    }
    
    /**
     * Controller function for add team record request.
     *
     * 
     * @return void
     */
    public function addAction()
    {
       if ($this->_initAJAXRequest() === true)
       {    
           if ($this->getRequest()->isPost())
           {
                $requestData = Zend_Json_Decoder::decode($this->getRequest()->getRawBody());
                $team = new Application_Model_DbTable_Teams();
                
                $exist = $team->checkDuplicate(0, $requestData['teamName']);
                if ($exist)
                {
                    $this->_helper->json(array('success' => -1, 'error' => 'Record with the same team name already exist: ' . $requestData['teamName']));
                }
                        
                $result = $team->addRecord($requestData['teamName']);
                if (is_numeric($result)) {
                    if ($result > 0) 
                    {
                        $roster = new Application_Model_DbTable_Roster();
                        $roster->autoGenerateTeamRoster($result, self::DEFAULT_ROSTER_COUNT, self::DEFAULT_STARTER_COUNT);
                    }
                    $this->_helper->json(array('success' => 1, 'newid' => $result, 'error' => ''));
                }
                $this->_helper->json(array('success' => -1, 'error' => $result));
            }
       }
    }
    
    /**
     * Handles team record delete request
     *
     * 
     * @return void
     */
    public function deleteAction()
    {
        if ($this->_initAJAXRequest() === true)
        {
            if ($this->getRequest()->isDelete())
            {
                $requestData = Zend_Json_Decoder::decode($this->getRequest()->getRawBody());
                $team = new Application_Model_DbTable_Teams();
                $result = $team->deleteRecord($requestData['requestId']);
                if (is_numeric($result)) {
                    $this->_helper->json(array('success' => 1, 'error' => ''));
                }
                $this->_helper->json(array('success' => -1, 'error' => $result));
            }
        }
    }
    
    /**
     * Handles team record edit request
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
                $team = new Application_Model_DbTable_Teams();
                $exist = $team->checkDuplicate($requestData['requestId'], $requestData['teamName']);
                if ($exist)
                {
                    $this->_helper->json(array('success' => -1, 'error' => 'Record with the same team name already exist: ' . $requestData['teamName']));
                }
                $result = $team->updateRecord($requestData['requestId'], $requestData['teamName']);
                if (is_numeric($result)) {
                    $this->_helper->json(array('success' => $result, 'error' => ''));
                }
                $this->_helper->json(array('success' => -1, 'error' => $result));
            }
        }
    }
}

