<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="dashlogo"></div>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if($userData['id'] != 0){
                    if($userData['userLevel'] == 'admin'){
                        echo '<li><a href="admin-dashboard.php">Main</a></li>';
                    }else{
                        echo '<li><a href="index.php">Main</a></li>';
                    }
                }

                ?>
                <li><a href="points-board.php">Current Points Board</a></li>
                <li><a href="affiliate.php">Affiliate</a></li>
                <?php
                if($userData['id'] == 0){
                    echo '<li><a href="login.php">Login</a></li>';
                }else{
                    echo '<li><a href="logout.php">Logout</a></li>';
                }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>