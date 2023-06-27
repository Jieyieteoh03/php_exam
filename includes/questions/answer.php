<?php

    // redirect to login page if user is not logged in
    if ( !isUserLoggedIn() ) {
        header( 'Location: /login' );
        exit;
    }

    // instruction: call DB class
    $db = new DB();

    // instruction: get all the questions
    $questions = $db -> fetchAll(
        "SELECT * FROM questions"
    );


    // loop through all the questions to make sure all the answers are set
    foreach ( $questions as $question ) {
        // instruction: if answer is not set, set $error
        if ( !isset( $_POST['q' . $question['id']] ) ) {
            $error = "Please enter answer";
        }
    }

    // if $error is set, redirect to home page
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header( 'Location: /' );
        exit;
    }

    // loop through all the questions to insert / update the answer to the database
    foreach ( $questions as $question ) {
        // check if the answer is already in the database
        $answer = $db->fetch(
            'SELECT * FROM results WHERE user_id = :user_id AND question_id = :question_id',
            [
                'user_id' => $_SESSION['user']['id'],
                'question_id' => $question['id']
            ]
        );

        // if answer is already in the database, update the answer
        if ( $answer ) {
            // instruction: call the $db->update() method to update the answer
            $db->update (
                "UPDATE results SET answer = :answer WHERE id = :id" ,
                [
                    'answer' => $_POST["q". $question["id"]]
                    
                ]
            );
            
        } else {
            // if answer is not in the database, insert the answer
            // instruction: call the $db->insert() method to insert the answer
            $db->insert( "INSERT INTO results (`answer`,`question_id`, `user_id`)
            VALUES(:answer, :question_id, :user_id)", 
            [
                'answer' => $_POST["q". $question["id"]],
                'question_id' => $question['id'],
                'user_id' => $_SESSION["user"]["id"],
            ]);


        }
    }

    // set success message
    $_SESSION['success'] = 'Your answers have been submitted';

    // instruction: redirect to home page
    header("Location: /");
    exit;
    