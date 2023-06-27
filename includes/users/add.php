<?php

    // instruction: redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }


    // instruction: call DB class
    $db = new DB();

    // instruction: get all POST data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];


    // instrction: make sure the email is not already taken by looking up the database
    $user = $db->fetch(
        "SELECT * FROM users where email = :email",
        [
            'email' => $email
        ]
    );

    /* 
        instruction: do error checking 
        - make sure all the fields are not empty
        - make sure password is match
        - make sure the password is at least 8 characters
        - make sure email entered wasn't already exists in the database
    */
    if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
        $error = 'Please enter field';
    } else if ($password !== $confirm_password){
        $error = "Password incorrect";
    } else if (strlen($password) < 8){
        $error = 'Not enough password';
    } else if ($user){
        $error = 'User invalid';
    }



    // instruction: if error found, set error message session & redirect user back to /manage-users-add page
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;

        header("Location: /manage-users-add");
        exit;
    }



    // instruction: if no error found, process to account creation
    $db->insert("INSERT INTO users (`name`, `email`, `password`,`role` )
    VALUES(:name, :email, :password, :role)" , 
    [
        'name' => $name,
        'email' => $email,
        'password' => password_hash( $password, PASSWORD_DEFAULT),
        'role' => $role
    ]);




    // set success message into session
    $_SESSION["success"] = "New user added successfully";

    // instruction: redirect user to home page
    header("Location: /manage-users");
    exit;