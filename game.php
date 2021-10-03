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
                transition: 0.2s;
            }
            .square.start:hover {
                background-color: chartreuse;
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
                    started = false;
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

            function myMove() {
                var elem = document.getElementById("end"); 
 
                var posX = 0;
                var posY = 0;

                const width = window.innerWidth;
                const height = window.innerHeight;

                let coords = getRandomPosition(width, height);

                let x = coords['x'];
                let y = coords['y'];

                let further = (Math.abs(x - posX) > Math.abs(y - posY) ? 'x' : 'y');

                if(further == 'x') {
                    var ratio = x/y;
                }
                else {
                    var ratio = y/x;
                }

                var interval = 10
                var id = setInterval(frame, interval);
                function frame() {
                    if (posX != x && posY != y) {
                        if(further == 'x') {
                            (posX > x ? posX -= ratio : posX += ratio);
                            (posY > y ? posY -- : posY ++);
                        }
                        else {
                            (posY > y ? posY -= ratio : posY += ratio);
                            (posX > x ? posX -- : posX ++);
                        }
                        elem.style.left = posX + "px"; 
                        elem.style.top = posY + "px"; 
                    }
                    else {
                        // TODO: move this to when the player wins
                        // clearInterval(id);
                        // if(interval > 2) {
                        //     interval --;
                        // }
                        // id = setInterval(frame, interval);
                        coords = getRandomPosition(width, height);

                        x = coords['x'];
                        y = coords['y'];
                    }
                }
            }

            function getRandomPosition(width, height) {
                let x = Math.floor(Math.random() * width) - 20;
                let y = Math.floor(Math.random() * height) - 20;

                return JSON.parse('{"x" : '+x+', "y" : '+y+'}');
            }
        </script>
    </head>
    <body 
        <?php
            //Only show instructions on first play
            session_start();
            if (empty($_SESSION['new'])){
                $_SESSION['new'] = 1;
                echo 'onload="startgame();myMove();"';
            }
            else{
                echo 'onload="myMove();"';
            }
        ?>  
    >
        <?php
            //100 randomly placed squares
            for($i = 0; $i < 100; $i++) {
                $x = rand(2,100);
                $y = rand(2,100);
                echo '<div class="square" onmouseover="lose();" style="left:calc('.$x.'% - 20px); top:calc('.$y.'% - 20px);"></div>';
            }

            //random start position
            $x = rand(2,100);
            $y = rand(2,100);
            echo '<div class="square start" onmouseover="start();" style="left:calc('.$x.'% - 20px); top:calc('.$y.'% - 20px);"></div>';

            //random end position
            $x = rand(2,100);
            $y = rand(2,100);
            // echo '<div id="end" class="square end" onmouseover="win();" style="left:calc('.$x.'% - 20px); top:calc('.$y.'% - 20px);"></div>';
            echo '<div id="end" class="square end" onmouseover="win();" style="left:0; top:0;"></div>';

        ?>
    </body>
</html>
