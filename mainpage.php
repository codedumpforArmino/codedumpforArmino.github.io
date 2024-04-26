<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../style/event.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
         document.querySelectorAll('.Joinbtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var eventId = this.getAttribute('data-eventid');
            fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'reqsub=1&RequestType=Join Event&RequestDesc=Interested to join Event&EventId=' + eventId,
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response if needed
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>

        <?php
            session_start();
            
            $events = json_decode(file_get_contents('../data/events.json'), true);
            $reviews = json_decode(file_get_contents('../data/reviews.json'), true);
            $Participants = json_decode(file_get_contents('../data/participants.json'), true);
            $display="";
            

            foreach ($events as $event) {
                $ParticipantCount = 0;
                foreach($Participants as $Participant){
                    if($event['id'] == $Participant['EventId']){
                        $ParticipantCount++;
                    }
                }

                $display .= "<form action='event_action.php' method='post'>
                                <div class='UniqueEventContainer'>
                                    <div class='EventTitle'>" . $event['title'] . "</div>
                                    <div class='EventBody'>
                                        <div class='Bodytop'>
                                            <div class='Date'><b>Date: </b>" . $event['time'] . "</div>
                                            <div class='EventDescription'>" . $event['body'] . "</div>
                                        </div>
                                        <div class='Bodybottom'>
                                            <div class='upvotes'><b>Upvotes: </b>" . $event['upvotes'] . "</div>
                                            <div class='participants'><b>Participants:</b> " .$ParticipantCount. "</div>
                                        </div>
                                    </div>
                                    <div class='EventAction'>
                                        <input type='hidden' name='event_id' value='" . $event['id'] . "'>
                                        <button type='submit' name='action' value='upvote' class='Upvotebtn'>Upvote</button>
                                        <button class='Joinbtn' id='joinbtn' name='action' value='joinEvent'>Join Event</button>

                                    </div>
                                    <div class='CommentSection'>";

                foreach ($reviews as $review) {
                    if ($review['EventId'] == $event['id']) {
                        $display .= "<div class='ReviewContainer'>
                                        <div class='ReviewName'>" . $review['name'] . "</div>
                                        <div class='ReviewBody'>" . $review['body'] . "</div>
                                    </div>";
                    }
                }
            
                $display .= "       <textarea class='form-control' id='desc' name='ReviewBody' rows='3'></textarea>
                                    <button class='Joinbtn' name='action' value='PostReview'>Post</button>
                                </div>
                            </div>
                        </form>";
            }
        ?>
    </head>
    <body>
        <div class="HeaderContainter">
            <h1>WEB DEV: Metro Event</h1>
            <div class="LowerHead">
                <h3 id="CurrentUser">Logged In as <?php echo $_COOKIE['Username']; ?></h3>
                <div class="interactables">
                    <button onclick="window.location.href = 'mainpage.php'" id="Home">Home</button>
                    <a href = "request_page.php">
                    <button id="dashboard">Request</button>
                    </a>
                    <a href = "notification.php">
                     <button id="createPost">Notifications</button>
                     </a>
                    <a href = "logout.php">
                    <button id="dashboard">Logout</button>    
                </a>                     
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
    </body>
</html>