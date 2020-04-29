<!DOCTYPE html>
<html>
    <head>
        <style>
            .square {
                height: 20px;
                width: 20px;
                background-color: darkgoldenrod;
                position: absolute;
                z-index: 1;
            }
            .square.start {
                background-color: green;
                z-index: 2;
            }
            .square.end {
                background-color: red;
                z-index: 2;
            }
        </style>
        <script>
            var started = false;

            function startgame(){
                alert("Hover over the green square to start.\nGet to the red square to win.\nDon't touch the yellow or you will lose.");
            }

            function start(){
                started = true;
            }

            function win(){
                if(started){
                    start = false;
                    alert("you win!");
                    location.reload();
                }
                else{
                    alert("Hover over the green square to start.")
                }
            }     

            function lose(){
                if(started){
                   alert("you lose!"); 
                   location.reload();
                }
            }
        </script>
    </head>
    <body 
        <?php
            //Only show instructions on first play
            session_start();
            if (empty($_SESSION['new'])){
                $_SESSION['new'] = 1;
                echo 'onload="startgame();"';
            }
        ?>  
    >
        <?php
            //100 randomly placed squares
            for($i = 0; $i < 100; $i++) {
                $x = rand(0,96);
                $y = rand(0,96);
                echo '<div class="square" onmouseover="lose();" style="left:'.$x.'%; top:'.$y.'%;"></div>';
            }

            //random start position
            $x = rand(0,100);
            $y = rand(0,100);
            echo '<div class="square start" onmouseover="start();" style="left:'.$x.'%; top:'.$y.'%;"></div>';

            //random end position
            $x = rand(0,100);
            $y = rand(0,100);
            echo '<div class="square end" onmouseover="win();" style="left:'.$x.'%; top:'.$y.'%;"></div>';
        ?>
    </body>
</html>
