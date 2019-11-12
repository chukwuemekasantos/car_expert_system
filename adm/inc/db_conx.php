<?php  
try {
    $db = new PDO('mysql:host=localhost;dbname=car_expert_system', 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage()."<br>";
    die();
}
?>