<?php

class Home extends controller
{
    public function index()
    {
        $clients =  $this->model('Client');
        $allClients = $clients->getAll();
        $this->view('home/index',  ['clients' => $allClients]);
    }

    public function addClient()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $client_status = $_POST['client_status'];

            $clientModel = $this->model('Client');
            $clientModel->addClient($firstname, $middlename, $lastname, $contact, $address, $gender, $client_status);

            header("Location: /CustomMVC/public/");
        }
    }

    public function deleteClient() 
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $client_id = $_POST['client_id'];
            //delete
            $success = $this->model('Client')->deleteClient($client_id);

            if ($success) {
                header('Location: /CustomMVC/public/');
                exit;
            } else {
                // Handle deletion failure
                echo "Failed to delete client.";
            }
        }
    }

    public function updateClient()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $client_id = $_POST['client_id'];
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'] ?? '';
            $lastname = $_POST['lastname'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $client_status = $_POST['client_status'];

            // Instantiate Client model
            $clientModel = $this->model('Client');
            $updated = $clientModel->updateClient($client_id, $firstname, $middlename, $lastname, $contact, $address, $gender, $client_status);

            if ($updated) {
                header('Location: /CustomMVC/public/');
                exit;
            } else {
                die('Update failed.');
            }
        } else {
            header('Location: /CustomMVC/public/');
            exit;
        }
    }
}