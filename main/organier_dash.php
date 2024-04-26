<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../style/event.css">
        <?php
            session_start();
            
            $events = json_decode(file_get_contents('../data/events.json'), true);
            $organizedEvents="";

            foreach($events as $event){
                if($event['OrganizerId'] == $_COOKIE['UserID']){
                    $organizedEvents .="<form action='event_action.php' method='post'>
                                    <div class='UniqueEventContainer'>
                                        <div class='EventTitle'>".$event['title']."</div>
                                        <div class='EventBody'>
                                            <div class='Bodytop'>
                                                <div class='Date'> <b>Date: </b>".$event['time']."</div>
                                                <div class='EventDescription'> ".$event['body']."</div>
                                            </div>
                                            <div class='Bodybottom'>
                                                <div class='upvotes'> <b>Upvotes: </b>".$event['upvotes']."</div>
                                                <div class='participants'> <b>Participants: </b> 100</div>
                                                <div class='status'> <b>Status: </b> ".$event['status']."</div>
                                            </div>
                                        </div>
                                        <div class='EventAction'>
                                            <input type='hidden' name='event_id' value='". $event['id'] ."'>
                                            <button type='submit' name='action' value='upvote' class='Upvotebtn'>Upvote</button>
                                            <button class='Joinbtn'>Join Event</button>
                                        </div>
                                        <div class='CommentSection'></div>
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
                    <button onclick="window.location.href = 'organier_dash.php'" id="Home">Home</button>
                    <a href = "participant_req.php">
                    <button id="dashboard">Request</button>
                    </a>
                    <a href = "notification.php">
                     <button id="createPost">Notifications</button>
                     </a>
                    <button onclick="window.location.href = 'index.php';" id="dashboard">Logout</button>                 
                </div>
            </div>
        </div>

        <div class="BodyContainer">
            <div class="Dashboard_container">
                <div class="newEvent_forum">
                    <h2>Create Event</h2>
                    <form action="event_action.php" method="post">
                        <label for="eventTitle">Event Title:</label>
                        <input type="text" id="eventTitle" name="eventTitle" required>

                        <label for="eventDescription">Event Description:</label>
                        <textarea id="eventDescription" name="eventDescription" rows="4" required></textarea>

                        <label for="eventTime">Event Time:</label>
                        <input type="date" id="eventTime" name="eventTime" required>

                        <button type="submit" name='action' value='createEvent'>Create Event</button>
                    </form>
                </div>
            </div>

            <div class="EventContainer">
                <div id="DataContainer">

                    <?php echo $organizedEvents; ?>

                </div>
            </div>

            <div class="sidebarContainer">
            </div>
        </div>
    </body>
</html>