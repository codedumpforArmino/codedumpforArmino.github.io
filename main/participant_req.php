<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Request</title>
    <link rel="stylesheet" type="text/css" href="../style/event.css">
    <?php
    include('api.php');

    $requests = getRequestsData();
    $display = "";

    foreach ($requests as $key => $request) {
        $display .= "<form action='api.php' method='post'>
                        <div class='UniqueEventContainer'>
                            <div class='EventTitle'>".$request['RequestType']."</div>
                            <div class='EventBody'>
                                <div class='Bodytop'>
                                    <div class='Date'> <b>User: </b>".$request['Username']."</div>
                                </div>
                                <div class='Bodybottom'>
                                    <div class='upvotes'>".$request['RequestDesc']."</div>
                                </div>
                            </div>
                            <div class='EventAction'>
                                <input type='hidden' name='request_id' value='" . $key . "'>
                                <input type='hidden' name='event_id' value='" . $request['EventId'] . "'>
                                <input type='hidden' name='caller' value='" . $_SERVER['PHP_SELF'] . "'>
                                <button type='submit' class='Joinbtn' name='action' value='accept'>Accept</button>
                                <button type='submit' class='Joinbtn' name='action' value='decline'>Decline</button>
                            </div>
                        </div>
                    </form>";
    }
    ?>
</head>
<body>
    <div class="HeaderContainter">
        <h1>Participant Request</h1>
        <div class="LowerHead">
            <h3 id="CurrentUser">Logged In as <?php echo $_COOKIE['Username']; ?></h3>
            <div class="interactables">
                <button onclick="window.location.href = 'mainpage.php'" id="Home">Home</button>
                <a href="request_page.php">
                    <button id="dashboard">Request</button>
                </a>
                <a href="notification.php">
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
        <div class="sidebarContainer"></div>
    </div>
</body>
</html>
