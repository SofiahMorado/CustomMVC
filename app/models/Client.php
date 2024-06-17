<?php

class Client extends Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM client");

        $clients = [];
        while ($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }

        return $clients;
    }

    public function addClient($firstname, $middlename, $lastname, $contact, $address, $gender, $client_status)
    {
        $stmt = $this->db->prepare("INSERT INTO client (firstname, middlename, lastname, contact, address, gender, client_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstname, $middlename, $lastname, $contact, $address, $gender, $client_status);
        return $stmt->execute();
    }

    public function deleteClient($client_id)
    {
        $stmt = $this->db->prepare("DELETE FROM client WHERE client_id = ?");
        $stmt->bind_param("i", $client_id);
        return $stmt->execute();
    }

    public function updateClient($client_id, $firstname, $middlename, $lastname, $contact, $address, $gender, $client_status)
    {
        $stmt = $this->db->prepare("UPDATE client SET firstname=?, middlename=?, lastname=?, contact=?, address=?, gender=?, client_status=? WHERE client_id=?");
        $stmt->bind_param("sssssssi", $firstname, $middlename, $lastname, $contact, $address, $gender, $client_status, $client_id);
        return $stmt->execute();
    }
}
?>
