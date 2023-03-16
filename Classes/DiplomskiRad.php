<?php

include('iRadovi.php');
class DiplomskiRad implements iRadovi {
    private $naziv_rada = NULL;
    private $tekst_rada = NULL;
    private $link_rada = NULL;
    private $oib_tvrtke = NULL;

    function __construct($data) {
        $this->_id = uniqid();
        $this->_naziv_rada = $data['naziv_rada'];
        $this->_tekst_rada = $data['tekst_rada'];
        $this->_link_rada = $data['link_rada'];
        $this->_oib_tvrtke = $data['oib_tvrtke'];
    }

    function create($data) {
        self::__construct($data);
    }

    function save() {
        $servername = "localhost:3306";
        $username = "root";
        $password = "admin";
        $dbname = "diplomski_radovi";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = $this->_id;
        $naziv = $this->_naziv_rada;
        $tekst = $this->_tekst_rada;
        $link = $this->_link_rada;
        $oib = $this->_oib_tvrtke;

        $sqlQuery = "INSERT INTO `diplomski_radovi` (`id`, `naziv_rada`, `tekst_rada`, `link_rada`, `oib_tvrtke`) VALUES ('$id', '$naziv', '$tekst', '$link', '$oib')";
        if($conn->query($sqlQuery) === true) {
            $this->read();
        }
        else {
            echo "Error! " . $sqlQuery . "<br>" . $conn->error;
        };
        $conn->close();
    }

    function read() {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "admin";
        $dbname = "diplomski_radovi";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sqlQuery = "SELECT * FROM `diplomski_radovi`";

        $output = $conn->query($sqlQuery);
        if ($output->num_rows > 0) {
            while($item = $output->fetch_assoc()) {
                echo "<br><br><br>ID: " . $item["id"] .
                    "<br><br>OIB tvrtke: " . $item["oib_tvrtke"] .
                    "<br><br>Naziv rada: " . $item["naziv_rada"] .
                    "<br><br>Link rada: " . $item["link_rada"] .
                    "<br><br>Tekst rada: " . $item["tekst_rada"];
            }
        }
        $conn->close();
    }
}