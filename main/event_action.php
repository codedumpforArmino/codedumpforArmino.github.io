<?php
    session_start();
            
    $eventsJSON = '../data/events.json';
    $events = json_decode(file_get_contents($eventsJSON), true);
    $action = $_POST['action'];
    $redirectUrl = "mainpage.php"; // Replace with your HTML page URL
    $reviews = json_decode(file_get_contents('../data/reviews.json'), true);
    $userId = $_COOKIE['UserID'];


    //function to upvote
        if ($action === 'upvote') {
            $eventId = $_POST['event_id'];
            foreach($events as $index => $event){
                if ($event['id'] == $eventId) {
                    $events[$index]['upvotes']++;
                    break;
                    }   
                }
                file_put_contents('../data/events.json', json_encode($events, JSON_PRETTY_PRINT));    
            }
           

    //function to add new event
    if($action === 'createEvent'){
        $redirectUrl = "mainpage.php?success=1";
        $eventID = count($events);
        
        $newData = array(
            "OrganizerId"=> $_COOKIE['UserID'],
            "id" => $eventID+1,
            "title" => $_POST['eventTitle'],
            "body" => $_POST['eventDescription'],
            "upvotes" => 0,
            "time" => $_POST['eventTime'],
            "status" => "ongoing"
        );

        $events[] = $newData;

        $updatedJSON = json_encode($events, JSON_PRETTY_PRINT);

        if ($updatedJSON === false) {
            echo "Error encoding updated data to JSON";
            exit;
        }
            
        file_put_contents($eventsJSON, $updatedJSON);
    }

    if($action === 'joinEvent'){
        $redirectUrl = "mainpage.php?success=2";
        $requestsJSON = '../data/request.json';
        $requests = json_decode(file_get_contents($requestsJSON), true);

        $newData = array(
            "UserID" => (int) $_COOKIE['UserID'],
            "Username" => $_COOKIE['Username'],
            "RequestType" => "Join Event",
            "RequestDesc" => "Interested to join Event",
            "EventId" => (int) $_POST['event_id']
        );

        $requests[] = $newData;

        $updatedJSON = json_encode($requests, JSON_PRETTY_PRINT);

        if ($updatedJSON === false) {
            echo "Error encoding updated data to JSON";
            exit;
        }
            
        file_put_contents($requestsJSON, $updatedJSON);
    }

    if($action ==='PostReview'){
        $redirectUrl = "mainpage.php?success=3";
        $reviewsJSON = '../data/reviews.json';
        $reviews = json_decode(file_get_contents($reviewsJSON), true);

        $newData = array(
            "EventId" => $_POST['event_id'],
            "id" => $_COOKIE['UserID'],
            "name" => $_COOKIE['Username'], 
            "body" => $_POST['ReviewBody']
        );

        $reviews[] = $newData;

        $updatedJSON = json_encode($reviews, JSON_PRETTY_PRINT);

        if ($updatedJSON === false) {
            echo "Error encoding updated data to JSON";
            exit;
        }

        var_dump($reviewsJSON);
            
        file_put_contents($reviewsJSON, $updatedJSON);
    }
    
    if($action === 'reqsub'){
        $redirectUrl = "request_page.php?success=1";
        $requestsJSON = '../data/request.json';
        $request = json_decode(file_get_contents($requestsJSON), true);

        $uid = $_COOKIE['UserID'];
        $uname = $_COOKIE['Username'];
        $type = $_POST['RequestType'];
        $reqdesc = "Request to be Organizer";

        $newData = array(
            'UserID' => (int) $uid,
            'Username' => $uname,
            'RequestType' => $type,
            'RequestDesc' => $reqdesc,
            'EventId' => 0,
        );

        $request[] = $newData;

        $updatedJSON = json_encode($request, JSON_PRETTY_PRINT);

        if ($updatedJSON === false) {
            echo "Error encoding updated data to JSON";
            exit;
        }

        var_dump($reviewsJSON);
            
        file_put_contents($requestsJSON, $updatedJSON);
    }

    header("Location: ". $redirectUrl);
    exit();
?>