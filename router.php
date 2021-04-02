<?php
include_once './classes/throttle.php';
include_once './classes/dbclass.php';
include_once './classes/places.php';

$traffic = new Throttle();
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
if(!empty($_POST)&& !empty($_POST['action'])){
    $action = $_POST['action'];
    if($traffic::trafficControll($action))
    {
        switch($action){
            case 'register':
            $data = json_decode(file_get_contents("php://input"));
            if(!empty($_POST['email'])&& !empty($_POST['id_place'])){
                $email = mysqli_real_escape_string($connection,$_POST['email']);
                $id_place = $_POST['id_place'];
                $places = new Places($connection);
                $data['content'] = $places->request($email,$id_place);
                $data['status'] = true;
                $data['message'] = 'success';
            }else{
                $data['status'] = false;
                $data['message'] = 'Place, email are mandatory';
            }
                
            break;
            default:
                $data['status'] = false;
                $data['message'] = 'Invalid request';
            break;
           
        }
    }else{
        $data['status'] = false;
        $data['message'] = 'Traffic is busy. Please try again after sometime.';
    }
    

}elseif(isset($_GET)&& !empty($_GET['action'])){
    $action = $_GET['action'];
    if($traffic::trafficControll($action)){
        switch($action){
            case 'listing':
                $places = new Places($connection);
                $data['content'] = $places->read();
                $data['status'] = true;
                $data['message'] = 'success';
            break;
            case 'details':
                $places = new places($connection);
                $id = $_GET['id'];
                $data['content'] = $places->readRow($id);
                $data['status'] = true;
                $data['message'] = 'success';

            break;
            default:
                $data['status'] = false;
                $data['message'] = 'Invalid request';
            break;
           
        }
    }else{
        $data['status'] = false;
        $data['message'] = 'Traffic is busy. Please try again after sometime.';
        }

    
}else{
    $data['status'] = false;
    $data['message'] = 'Invalid request';
}

echo json_encode($data);die();
?>