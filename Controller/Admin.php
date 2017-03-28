<?php

class Controller_Admin extends System_Controller
{
    public function indexAction()
    {
        $userRole = $this->_getSessParam('userRole');
        $userId = $this->_getSessParam('currentUser');

        if ($userRole == Model_User::ROLE_ADMIN) {
            try {
                $modelUser = Model_User:: getById($userId);
                $this->view->setParam('user', $modelUser);
            } catch (Exception $e) {
                $this->view->setParam('error', $e->getMessage());
            }

        } else {
            header('Location: /');
        }
    }

    public function productAction()
    {

        try {
            $modelProduct = Model_Admin_Product:: getAll();

            $this->view->setParam('product', $modelProduct);
        } catch (Exception $e) {
            $this->view->setParam('error', $e->getMessage());
        }
    }

    public function userAction()
    {

        try {
            $modelUser = Model_Admin_User:: getAll();

            $this->view->setParam('user', $modelUser);
        } catch (Exception $e) {
            $this->view->setParam('error', $e->getMessage());
        }
    }

    public function userOrder()
    {

        try {
            $modelOrder = Model_Admin_Order:: getAll();

            $this->view->setParam('user', $modelOrder);
        } catch (Exception $e) {
            $this->view->setParam('error', $e->getMessage());
        }
    }
}