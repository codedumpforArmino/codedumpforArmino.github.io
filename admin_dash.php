<html>
<head>
    <link rel="stylesheet" type="text/css" href="../style/event.css">
    <?php
    include('api.php');

    $events = getEventsData();
    $requests = getRequestsData();
    $display = "";
    $DisplayRequest = "";

    foreach ($events as $event) {
        $display .= "<form action='api.php' method='post'> <!-- Change the action here -->
                        <div class='UniqueEventContainer'>
                            <div class='EventTitle'>" . $event['title'] . "</div>
                            <div class='EventAction'>
                                <input type='hidden' name='event_id' value='" . $event['id'] . "'>
                                <button type='submit' name='delete' class='dltbtn'>Delete Event</button>
                            </div>
                        </div>
                    </form>";
    }

    foreach ($requests as $key => $request) {
        if($request['EventId'] == 0){
            $DisplayRequest .= "<form action='api.php' method='post'> <!-- Change the action here -->
                        <div class='UniqueEventContainer'>
                            <div class='EventTitle'>" . $request['RequestType'] . "</div>
                            <div class='EventBody'>
                                            <div class='Bodytop'>
                                                <div class='Date'> <b>User: </b>".$request['Username']."</div>
                                            </div>
                                            <div class='Bodybottom'>
                                                <div class='upvotes'> ".$request['RequestDesc']."</div>
                                            </div>
                                        </div>
                            <div class='EventAction'>
                                <input type='hidden' name='caller' value='" .$_SERVER['PHP_SELF']. "'>
                                <input type='hidden' name='request_id' value='" . $key . "'>
                                <button type='submit'  name='action' value='Approve' class='dltbtn'>Approve</button>
                                <button type='submit'  name='action' value='Decline' class='dltbtn'>Decline</button>
                            </div>
                        </div>
                    </form>";
        }
    }
        ?>
    </head>
    <body>
        <div class="HeaderContainter">
            <h1>WEB DEV: Metro Event</h1>
            <div class="LowerHead">
                <h3 id="CurrentUser">Logged In as <?php echo $_COOKIE['Username']; ?></h3>
                <div class="interactables">
                    <button onclick="window.location.href = 'admin_dash.php'" id="Home">Home</button>
                    <button id="Dashboard">Request</button>
                    <button id="CreatePost">Notifications</button>
                    <a href = "logout.php">
                    <button id="dashboard">Logout</button>    
                </a>             
                </div>
            </div>
        </div>

        <div class="BodyContainer">
            <div class="EventContainer">
                <div id="DataContainer">
                    <h2>Delete Events</h2>
                    <?php echo $display; ?>
                    <h2>Approve Organizer</h2>
                    <?php echo $DisplayRequest; ?>
                </div>
            </div>

            <div class="sidebarContainer">
            </div>
        </div>
    </body>
</html>