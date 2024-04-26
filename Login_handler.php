<?php
    session_start();
            
    $users = json_decode(file_get_contents('../data/users.json'), true);
    
    $Uname = $_POST['username'];
    $Upass = $_POST['userpassword'];
    $action = $_POST['action'];

    if($action === 'LogIn'){
        $LogInStatus = 0;
        $redirectUrl = "index.php?error=1";
        $userType = "";

        foreach ($users as $user) {
            if ($user['Username'] == $Uname && $user['Userpassword'] == $Upass) {
                $userType = $user['UserType'];
                setcookie('UserType', $userType, time() + 86400 * 30, "/");
                setcookie('Username', $user['Username'], time() + (86400 * 30), "/");
                setcookie('UserID', $user['UserID'], time() + (86400 * 30), "/");
    
                $LogInStatus = 1;
                break;
            }
        }
    
        if($LogInStatus == 1){
            if ($userType === 'regular') {
                $redirectUrl = "mainpage.php";
            } else if ($userType === 'organizer') {
                $redirectUrl = "organier_dash.php";
            } else {
                $redirectUrl = "admin_dash.php";
            }
        }
    }
    else if($action === 'Register'){
        $redirectUrl = "index.php?success=1";
        $UsersJSON = '../data/users.json';
        $data = json_decode(file_get_contents($UsersJSON), true);
        $UserID = count($data);
        
        $newData = array(
            "UserID" => $UserID + 1, // Assign a new ID (assuming IDs are sequential)
            "Username" => $Uname,
            "Userpassword" => $Upass,
            "UserType" => "regular"
        );
        
        $data[] = $newData;
        
        $updatedJSON = json_encode($data, JSON_PRETTY_PRINT);
        
        if ($updatedJSON === false) {
        echo "Error encoding updated data to JSON";
        exit;
        }
        
        file_put_contents($UsersJSON, $updatedJSON);
    }

    header("Location: $redirectUrl");
    exit();
?>