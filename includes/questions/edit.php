<?php

    // redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    // instruction: call DB class
    $db = new DB();

    // instruction: get all POST data
    $question = $_POST["question"];
    $answer = $_POST["answer"];
    $id = $_POST["id"];

    /* 
        instruction: do error checking 
        - make sure all the fields are not empty
    */
    if(empty($question) || empty($answer)) {
        $error = "Please enter field";
    }



    
    // if error found, set error message session & redirect user back to /manage-questions-edit page
    if ( isset( $error ) ) {
        $_SESSION["error"] = $error;
        header("Location: /manage-questions-edit?id=$id");
        exit;
    }

    // instruction: update question
    $db -> update (
        "UPDATE questions SET question = :question, answer = :answer WHERE id = :id" ,
        [
            'question' => $question,
            'answer' => $answer,
            'id' => $id
        ]
    );


    // set success message
    $_SESSION["success"] = "Question updated";

    // instruction: redirect user back to manage-questions page
    header("Location: /manage-questions");
    exit;