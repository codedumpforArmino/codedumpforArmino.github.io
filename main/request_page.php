<html>
<head>
    <link rel="stylesheet" type="text/css" href="../style/event.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php
    include('api.php');
    ?>
</head>
<body>
    <div class="HeaderContainter">
        <h1>Request Page</h1>
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
                <a href="logout.php">
                    <button id="dashboard">Logout</button>
                </a>
            </div>
        </div>
    </div>

    <form action="event_action.php" method="post">
        <div class="form-group">
        <label for="type">Request Type</label>
        <select class="form-control" name="RequestType">
            <option value="Join Event">Join Event</option>
            <option value="Organizer Request">Organizer Request</option>
        </select>
            <label for="desc">Request Description</label>
            <textarea class="form-control" id="desc" name="RequestDesc" rows="3"></textarea>
            <input type='hidden' name='caller' value='" . $_SERVER['PHP_SELF'] . "'>
            <button class="btn btn-primary" type="submit" name="action" value="reqsub">Submit</button>
        </div>
    </form>

    <div class="sidebarContainer">
    </div>
</body>
</html>
