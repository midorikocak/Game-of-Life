<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Life Implementation</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link href='http://fonts.googleapis.com/css?family=PT+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <script src="js/vendor/modernizr.js"></script>
</head>
<body>
  
    <div class="row">
        <div class="large-8 large-centered columns" id="box">


            
            <?php
            if(isset($_POST['cells'])){
                $cells = $_POST['cells'];
            }
            if(isset($_POST['iterations'])){
                $iterations = $_POST['iterations'];
            }
            if(isset($_POST['species'])){
                $species = $_POST['species'];
            }
            else{
                if(isset($_SESSION['cells'])){
                    $cells = $_SESSION['cells'];
                }
                if(isset($_SESSION['iterations'])){
                    $iterations = $_SESSION['iterations'];
                }
                if(isset($_SESSION['species'])){
                    $species = $_SESSION['species'];
                }
                if(isset($_SESSION['squares'])){
                    $squares = $_SESSION['squares'];
                }
            }
            
            if(isset($_POST['squares'])){
                $squares = $_POST['squares'];
            }
            ?>

            
            <?php
            if(isset($cells)):
            ?>
                        <h1>Life Starts!</h1>
            <canvas id="canvas" width="<?=$cells*16;?>" height="<?=$cells*16;?>"></canvas><br/>
            Generations: <span id="generations">0</span><br/><br/>
            <div class="row">
                <div class="large-4 columns">
                    <button id="start" class="button">Start!</button>
                </div>
                <div class="large-4 columns">
                    <button id="stop" class="button disabled" disabled>Stop!</button>
                </div>
                <div class="large-4 columns">
                    <button onclick="window.location.href='out.xml'"  id="download" class="button disabled" disabled>Download State</button>
                </div>
            </div>
            <?php
            endif;
            ?>
            <p>Midori Kocak - 2014</p>
        </div>
    </div>


    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/draw.js"></script>
    
    <script>
    $(window).load(function(){
        var worker = new Worker('js/life.js');
        var generations = 0;
        var squares = [];
        worker.addEventListener('message', function(e) {
          draw(e.data,<?=$cells;?>,<?=$species;?>);
          squares = e.data;
          generations++;
          $('#generations').text(generations);
        }, false);
        
        <?php
        if(isset($squares)){
            ?>
        var squares = <?=$squares?>;
        worker.postMessage({'cells':<?=$cells?>,'species':<?=$species?>+1,'squares':squares}); 
            <?php
        }
        else{
            ?>
            worker.postMessage({'cells':<?=$cells?>,'species':<?=$species?>+1}); 
            <?php
        }  
        ?>
        
        $('#start').click(function(){
            
            $('#start').attr("disabled", true);
            $('#start').addClass("disabled");
            
            $('#stop').removeAttr("disabled");
            $('#stop').removeClass("disabled");
            
            <?php
            if(isset($squares)){
                ?>
            var squares = <?=$squares?>;
            worker.postMessage({'cells':<?=$cells?>,'species':<?=$species?>+1,'iterations':<?=$iterations?>,'squares':squares}); 
                <?php
            }
            else{
                ?>
                worker.postMessage({'cells':<?=$cells?>,'species':<?=$species?>+1,'iterations':<?=$iterations?>}); 
                <?php
            }  
            ?>
        });
    
        $('#stop').click(function(){
            
            $('#stop').attr("disabled", true);
            $('#stop').addClass("disabled");
            
            $('#download').removeAttr("disabled");
            $('#download').removeClass("disabled");
            
            worker.terminate();
            
            var result = 'result='+JSON.stringify(squares)+'&cells=<?=$cells?>&species=<?=$species?>&iterations=<?=$iterations?>'; 
            $.ajax({ 
              		type:'POST', 
              		url:'save.php', 
              		data:result,
              		success:function(data){
                        console.log(data);
              		}
              	});
        });
        
    });
    </script>
    
    <script>
    $(document).foundation();
    </script>
</body>
</html>
