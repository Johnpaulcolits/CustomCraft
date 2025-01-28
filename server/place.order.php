<?php

include_once "../php/config.php";

session_start();

if(isset($_POST['place_order'])){


    //1.get user info and store it in database
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['cart_total'];
    $order_status ="on_hold";
    $user_id = $_SESSION['unique_id'];
    $order_date =date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
    VALUES(?,?,?,?,?,?,?);");

    $stmt->bind_param("isiisss",$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);


    $stmt->execute();









    //2. get products from cart (from session)


    






    //3. issue new order and store order info in database



    //4. store each single item in order_items database



    //5. remove everything from cart


    //6. infrom user whether everything is fine or there is a problem





}