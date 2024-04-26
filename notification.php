<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" type="text/css" href="../style/event.css">
    <?php
    include('api.php');

    $notifications = getNotificationsData();
    $display = "";
    $loggedInUserId = $_COOKIE['UserID'];

    foreach ($notifications as $notification) {

        if ($notification['UserID'] == $loggedInUserId) {
        $display .= "<form action='api.php' method='post'>
                        <div class='UniqueEventContainer'>          
                            <h4>" . $notification['body'] . "</h4>
                                <input type='hidden' name='notification_id' value='" . $notification['id'] . "'>
                                <button type='submit' name='delete_notification' class='dltbtn'>OKEY</button>
                           
                        </div>
                    </form>";
    }
}
    ?>
</head>
<body>
    <div class="HeaderContainter">
        <h1>Notifications</h1>
        <div class="LowerHead">
            <h3 id="CurrentUser">Logged In as <?php echo $_COOKIE['Username']; ?></h3>
            <div class="interactables">
                <button onclick="window.location.href = 'mainpage.php'" id="Home">Home</button>
                <a href = "request_page.php">
                    <button id="dashboard">Request</button>
                    </a>
                    <a href = "notification.php">
                     <button id="dashboard">Notifications</button>
                     </a>
                    <button onclick="window.location.href = 'index.php';" id="dashboard">Logout</button>      
            </div>
        </div>
    </div>
    <div class="BodyContainer">
            <div class="EventContainer">
                <div id="DataContainer">
                    <?php echo $display; ?>
                </div>
            </div>

            <div class="sidebarContainer">
            </div>
        </div>
</html>