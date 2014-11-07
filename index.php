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
        <div class="large-4 large-centered columns" id="box">
            <h1>Life</h1>
            <p>Alghoritm Implementation using Web Workers. Random Generated World - Midori Kocak</p>
            <form action="life.php" method="post">
                <div class="row">
                    <div class="small-3 columns">
                        <label for="cells" class="right inline">Size of World</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="number" id="cells" name="cells" min="2" placeholder="Square size of cells">
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="species" class="right inline">How Many Species?</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="number" id="species" name="species" min="1" max="5" placeholder="Different species in the world">
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="iterations" class="right inline">How Many Iterations?</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="number" id="iterations" name="iterations" min="1" placeholder="How many generations the world live?">
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <button class="right" type="submit">Next</button>
                    </div>
                </div>
            </form>
            <br />
            <p>Or submit an xml file </p>
            <form action="open.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="small-3 columns">
                        <label for="file" class="right inline">Inıtıal file</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="file" id="file" name="file">
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <button class="right" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>



    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
    $(document).foundation();
    </script>
</body>
</html>
