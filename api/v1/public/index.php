<?php
require '../../vendor/autoload.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App;
//cors 
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
$app->get('/students', function () {
    $sql = "SELECT * FROM users LIMIT 30";
    try {
        require_once('dbconnect.php');
        $stmt = $dbh->query($sql);
        $students = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($students);
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});
//get single student
$app->post('/student', function ($request) {
    $id = $request->getParam('id');
    $sql = "SELECT * FROM `dizcoveries` WHERE `discovered_by` = ".$id;
    try {
       $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bita";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    $sql2 = "SELECT * FROM `dizcoveries` WHERE `id`< ".$id;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo (mysqli_fetch_all($result,MYSQLI_ASSOC));
            }
         else {
            echo "0 results";
        }
        $conn->close();
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});
//add student
$app->post('/students/add', function ($request) {
    $firstname = $request->getParam('firstname');
    $lastname = $request->getParam('lastname');
    $matric = $request->getParam('matric');
    $email = $request->getParam('email');
    $sql = "INSERT INTO student (firstname, lastname, matric, email) VALUES (:firstname, :lastname, :matric, :email)";
    try {
        require_once('dbconnect.php');
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam("firstname", $firstname);
        $stmt->bindParam("lastname", $lastname);
        $stmt->bindParam("matric", $matric);
        $stmt->bindParam("email", $email);
        $stmt->execute();
      
        $db = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});
//update
$app->put('/students/update/{id}', function ($request) {
    $id = $request->getAttribute('id');
    
    $firstname = $request->getParam('firstname');
    $lastname = $request->getParam('lastname');
    $matric = $request->getParam('matric');
    $email = $request->getParam('email');
    $sql = "UPDATE student SET firstname=:firstname, lastname=:lastname, matric=:matric, email=:email WHERE id=$id";
    try {
        require_once('dbconnect.php');
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam("firstname", $firstname);
        $stmt->bindParam("lastname", $lastname);
        $stmt->bindParam("matric", $matric);
        $stmt->bindParam("email", $email);
        $stmt->execute();
        $db = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});
//delete record
$app->delete('/students/delete/{id}', function ($request) {
    $id = $request->getAttribute('id');
    
    $sql = "DELETE FROM student WHERE id=".$id;
    try {
        require_once('dbconnect.php');
    
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $dbh = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});
//pdo
$app->run();