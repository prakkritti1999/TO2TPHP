<style>
    body{
        background-color: whitesmoke;
    }
    a{
        color: black;
    }
</style>
<body>
    <?php
    session_start();
    session_unset();
    session_destroy();

    echo '<h2>'
        . 'You are logged out successfully.'
        . '<a href="login.php">Click here</a> to login again.</h2>';
    ?>
</body>

