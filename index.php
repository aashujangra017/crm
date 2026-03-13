<?php

// require_once "app/routes/router.php";


// $router = new route();




require_once 'app/routes/router.php';
require_once 'app/controllers/userController.php';

require_once 'app/controllers/authController.php';
require_once 'app/controllers/loginController.php';
require_once 'app/controllers/clientController.php';
require_once 'app/controllers/itemController.php';

require_once 'app/controllers/invoiceController.php';

$router = new Router();

$router->addRoute('/cool', function() {  
    $controller = new userController();
    $controller->createForm();
});




$router->addRoute('/cool/insert', function() { 
    $controller = new userController();
    $controller->insert();
});


//client controller start form here
// $router->addRoute('/cool/insert', function() { 
//     $controller = new clientController();
//     $controller->insert();
// });



// $router->addRoute('/cool/navbars', function() {  
//     $controller = new userController();
//     $controller->navbar();
// });




// $router->addRoute('/cool/homes', function() {  
// require_once __DIR__ . '/../app/controllers/routesprotected.php';
//     $controller = new userController();
//     $controller->home();
// });





$router->addRoute('/cool/login', function() {  
    $controller = new userController();
    $controller->login();
});




$router->addRoute('/cool/register', function() {  
    $controller = new userController();
    $controller->register();
});


$router->addRoute('/cool/auth',function(){
    $controller = new authController();
    $controller->registeruser();
});



// $router->addRoute('/cool/auth', function() {
    
//     $controller = new authController();
//     // $controller->registeruser();
//     $controller->login();
  
// });
$router->addRoute('/cool/userlogin', function() {
    
    $controller = new loginController();
    $controller->loginmethod();
});



// $router->addRoute('/cool/logout', function() {
//     $controller = new loginController();
//     $controller->logoutuser();
// }, 'POST');

$router->addRoute('/cool/logout', function() {
    $controller = new authController(); 
    $controller->logoutuser();
});



// fetch user form the table 


$router->addRoute('/cool/fetch-users', function() {
    $controller = new userController();
    $controller->fetch();
});


// searh user in the table



$router->addRoute('/cool/search-users',function(){
    $controller = new userController();
    $controller->searchforuser();
});


// delete user 
$router->addRoute('/cool/delete',function(){
    $controller = new userController();
    $controller->delete();
});

//limit

$router->addRoute('/cool/limit',function(){
    $controller = new userController();
    $controller->limit();
});

//order by start form here

$router->addRoute('/cool/order',function(){
    $controller = new userController();
    $controller->order();
});



$router ->addRoute('/cool/pagination', function(){
    $controller = new userController();
    $controller->pagination();
});

// select the user by id for update the user 
$router->addRoute('/cool/selectid',function(){
    $controller = new userController();
    $controller->selectid();

});

// update user routest 

$router->addRoute('/cool/update',function(){
    $controller = new userController();
    $controller->update();
});


// load status routes
$router->addRoute('/cool/status',function(){
    $controller = new userController();
    $controller->status();
});

$router->addRoute('/cool/user-pagination',function(){
    $controller = new userController();
    $controller->pagination();
});

// order by asc and desc for the user master start from here 

$router->addRoute('/cool/user-order',function(){
    $controller = new userController();
    $controller->userorder();
});



// dashhome start form here 



$router->addRoute('/cool/dashboard',function(){
    $controller = new userController();
    $controller->dashboard();
});



$router->addRoute('/cool/invoice',function(){
    $controller = new userController();
    $controller->invoice();
});

// erro page start from here 

$router->addRoute('*', function() {

$controller= new userController();
$controller->error();
    
   
});













//again user master start form here 

$router->addRoute('/cool/userhome',function(){
// require_once __DIR__ . '/app/controllers/routesprotected.php';
    $controller = new userController();
    $controller->userhome();
});

$router->addRoute('/cool/user-search',function(){
    $controller = new userController();
    $controller->search();
});








//client master start form here 
$router->addRoute('/cool/client',function(){
    $controller = new clientController();
    $controller->clienthome();
});


$router->addRoute('/cool/insert-client',function(){
    $controller = new clientController();
    $controller->insertclient();
});


$router->addRoute('/cool/states',function(){
    $controller = new clientController();
    $controller->states();
});


$router->addRoute('/cool/cities',function(){
    $controller = new clientController();
    $controller->cities();
});


$router->addRoute('/cool/fetch-client',function(){
    $controller = new clientController();
    $controller->fetchclient();
});

$router->addRoute('/cool/delete-client',function(){
    $controller = new clientController();
    $controller->delete();
});
//select id for update to select
$router->addRoute('/cool/clientid', function(){
    $controller = new clientController();
    $controller->selectclientform();
});


$router->addRoute('/cool/update-client', function(){
    $controller = new clientController();
    $controller->update();
});


//search routes start form here 

// $router->addRoute('/cool/search-client', function(){
//     $controller = new clientController();
//     $controller->search();
// });



// pagination and limit start from here 
$router->addRoute('/cool/client-pagination', function(){
    $controller = new  clientController();
    $controller->clientpagination();
});



// $router->addRoute('/cool/client-order', function(){
//     $controller = new  clientController();
//     $controller->clientorder();
// });















//item routes start form here

$router->addRoute('/cool/item',function(){
    $controller = new itemController();
    $controller->itemhome();
});

//hoem page for item

$router->addRoute('/cool/home',function(){
    $controller = new itemController();
    $controller->itemhome();
});

//insert routes start form here 
$router->addRoute('/cool/item-insert',function(){
    $controller = new itemController();
    $controller->iteminsert();
});


//fetch routes start form here 
$router->addRoute('/cool/item-fetch',function(){
    $controller = new itemController();
    $controller->fetchitem();
});
//search routes start from here 
$router->addRoute('/cool/item-search',function(){
    $controller = new itemController();
    $controller->search();
});


// delete  routes start form here 
$router->addRoute('/cool/item-delete',function(){
    $controller = new itemController();
    $controller->delete();
});
//select id for the update routes
$router->addRoute('/cool/itemid',function(){
    $controller = new itemController();
    $controller->itemselect();
});

// udpate routes start 
$router->addRoute('/cool/item-update',function(){
    $controller = new itemController();
    $controller->itemupdate();
});

//limit and pagination 
$router->addRoute('/cool/item-pagination',function(){
    $controller = new itemController();
    $controller->itempagination();
});


$router->addRoute('/cool/item-order',function(){
    $controller = new itemController();
    $controller->orderitems();
});


























//invoice start form here

$router->addRoute('/cool/clientdetails',function(){
    $controller = new invoiceController();
    $controller->getclientfetchDetails();
});


$router->addRoute('/cool/itemsdetails',function(){
    $controller = new invoiceController();
    $controller->getitemfetchDetails();
});





$router->addRoute('/cool/invoice-create',function(){
    $controller = new InvoiceController();
      $controller->saveInvoice();
});


$router->addRoute('/cool/invoice-fetch',function(){
    $controller = new InvoiceController();
      $controller->fetchinvoice();
});



// invoice pagination start form here


$router->addRoute('/cool/invoice-pagination',function(){
    $controller = new InvoiceController();
      $controller->invoicepagination();
});


// get client name api
$router->addRoute('/cool/getclients',function(){
    $controller = new InvoiceController();
      $controller->getclient();
});


// get items name 
$router->addRoute('/cool/getitems', function() {
    $controller = new InvoiceController();
    $controller->getitem();
});











$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = rtrim($request, '/') ?: '/'; 
$router->dispatch($request);
?>