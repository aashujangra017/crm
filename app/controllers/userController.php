<?php


require_once __DIR__ . "/../models/user.php";


class userController{

public function createForm() {
       require __DIR__ . "/../../public/views/userCreate.php";
    }


 public function navbar() {
     require __DIR__ . "/../../public/views/navbar.php";
}
 

public function home(){
    require __DIR__ ."/../../public/views/userhome.php";
    
}


public function login(){
    require __DIR__ . "/../../public/views/login.php";
}


public function register(){
    require __DIR__ . "/../../public/views/register.php";
}


public function userhome(){
    
    require __DIR__ . "/../../public/views/userhomes.php";
}


public function dashboard(){
    require __DIR__ . "/../../public/views/dashboard.php";
}



public function insert(){
 
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['status'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];

        $object = new user();
        $object->create($name, $email, $phone, $status);
    } else {
        echo "POST data missing"; 
    }
}


//delete start fomm here




public function delete() {

    

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $object = new user(); 
        $result = $object->deleteusers($id);

        if ($result) {
            echo "success"; 
        } else {
            echo "failed to delete user";
        }

    } else {
        echo "User ID missing";
    }
}








// fetch controller start from here 
public function fetch(){

$object = new user();
$users = $object->fetchusers();

require_once 'usertable.php';

    }







    //update start form here

    public function update(){
          if (isset($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['status'])) {

           $id = (int)$_POST['id'];
           $name = $_POST['name'];
           $email = $_POST['email'];
           $phone = $_POST['phone'];
           $status = $_POST['status'];

           $object = new user();
           $result = $object->updateuser($id,$name,$email,$phone,$status);
           
           if($result){
            echo "success";
           }else{
            echo "error";
           }


    }else{
        echo "Post data is missing";
    }

    }



// search user controller start form here

public function searchforuser(){

   $name   = $_POST['searchname'] ?? '';
   $email  = $_POST['searchemail'] ?? '';
   $phone  = $_POST['searchphone'] ?? '';
   $status = $_POST['searchstatus'] ?? '';

    $object = new user();
    $users = $object->searchuser($name,$email,$phone,$status);

    require_once 'usertable.php';

   
}



//limit controller start from here 

public function limit(){

  if(isset($_POST['limit'])){

  $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 5;

 

  $object = new user();
  $users = $object->limituser($limit);

require_once 'usertable.php';



 }
 }

 


 //update select start from here 


public function selectuserform() {

    if (isset($_POST['id'])) {

        $id = (int)$_POST['id'];  

        $object = new user();
        $userResult = $object->selectuser($id); 

        if ($userResult && $userResult->num_rows > 0) {
            $row = $userResult->fetch_assoc();

            echo "
            <form id='edit-user-form'>
                <input type='hidden' id='edit-id' value='{$row['id']}'>

                <div class='container'>
                
                    <div class='row'>
                        <div class='col-md-6 mb-3'>
                            <label for='edit-name' class='form-label'>Name</label>
                            <input type='text' id='edit-name' class='form-control' value='{$row['name']}'>
                            <small class='text-danger' id='name-error'></small>
                        </div>

                        <div class='col-md-6 mb-3'>
                            <label for='edit-email' class='form-label'>Email</label>
                            <input type='text' id='edit-email' class='form-control' value='{$row['email']}'>
                             <small class='text-danger' id='email-error'></small>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-md-6 mb-3'>
                            <label for='edit-phone' class='form-label'>Phone</label>
                            <input type='text' id='edit-phone' class='form-control' value='{$row['phone']}'>
                             <small class='text-danger' id='phone-error'></small>
                            
                        </div>

                        <div class='col-md-6 mb-3'>
                            <label for='edit-status' class='form-label'>Status</label>
                            <input type='text' id='edit-status' class='form-control' value='{$row['status']}'>
                            <small class='text-danger' id='status-error'></small>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-3 mt-2'>
                            <button type='button' id='update-user' class='btn btn-danger w-100'>Save</button>
                        </div>
                        
                    </div>

                </div>
            </form>
            ";
        } else {
            echo "<p>No Record Found</p>";
        }

    } else {
        echo "<p>User ID missing</p>";
    }

}


    

public function status(){

    $object = new user();
    $result = $object->getAllStatus();

    $options = "";

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            $options .= "<option value='".$row['id']."'>".$row['sname']."</option>";

        }

    }

    echo $options;
}





    public function search (){
        if(isset($_POST['search'])){
            $keyword = $_POST['search'];

            $object = new user();
           $users = $object->searchusers($keyword);

           require_once 'usertable.php';
        }
    }




// pagination controller start form here 


public function pagination (){

 header('Content-Type: application/json');
    $page = isset($_POST['page']) ? (int) $_POST['page'] :1;

    $limit = isset($_POST['limit']) ? (int)$_POST['limit'] :5;

    if($page <1){
        $page = 1;
    }
     

    $offset = ($page -1) * $limit;


    $object = new user();
    $users = $object->getuserbypage($limit,$offset);

    $totalUsers = $object->countuser();

    $totalPages = ceil($totalUsers / $limit);
    
$table = "";

if($users->num_rows > 0){

while($row = $users->fetch_assoc()){

 $statusText = ($row['status'] == 1) ? 'Active' : 'Inactive';

$table .= "<tr>

<td>{$row['id']}</td>

<td>{$row['name']}</td>

<td>{$row['email']}</td>

<td>{$row['phone']}</td>

<td>{$statusText}</td>

 <td>
                    <button class='deletebutton btn btn-danger' data-id='{$row['id']}'>
                        Delete
                    </button>
                </td>
                <td>
                    <button class='edit-btn btn btn-primary' data-eid='{$row['id']}'>
                        Update
                    </button>
                </td>

</tr>";

}

}

$response = [

"table"=>$table,
"page"=>$page,
"totalPages"=>$totalPages

];

echo json_encode($response);

}



//order controller start from here 


public function userorder(){

    if(isset($_POST['column'])){

        $column = $_POST['column'];

        $order = $_POST['order'];

        if($column != 'id' && $column != 'name' && $column != 'email'){
            $column ='id';
        }

        if($order != 'ASC' && $order != 'DESC'){
            $order ='ASC';
        }

        $object = new user();

        $users = $object->orderuser($column,$order);

        require 'usertable.php';
    }
}





}

?>