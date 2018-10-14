<?php

trait RequestHandler 
{
    
    /**
     * Validates incoming JSON request
     *
     * 
     * @return void
     */
    protected function _initAJAXRequest() {
        //disable HTML rendering
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    
        //validate if the request is a valid AJAX request
        if ($this->getRequest()->isXmlHttpRequest()) {
            $authBearer = $this->getRequest()->getHeader('Authorization');
            if ($authBearer != self::HTTP_AUTH_VALUE)
            {
                header('Content-Type: application/json; charset=UTF-8');
                $this->_helper->json(json_encode(array('success' => 0, 'message' => 'HTTP: Access Denied')));
                return false;
            }
        }
        else
        {
            header('Content-Type: application/json; charset=UTF-8');
            $this->_helper->json(json_encode(array('success' => 0, 'message' => 'Not a valid AJAX request')));
            return false;
        }
    
        return true;
    }
}

?>