<!DOCTYPE html>
<html>

<head>
    <title>Flat Admin V.2 - Free Bootstrap Admin Templates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="lib/css/select2.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/themes/flat-blue.css">

    <style>
      #map {
        width: 700px;
        height: 450px;
      }
    </style>

<script src="http://maps.googleapis.com/maps/api/js"></script>

<script charset="UTF-8">



                function initialize(lat,longitud) {
                  var mapProp = {
                    center:new google.maps.LatLng(19.702688, -101.192188),
                    zoom:5,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                  };
                  mapa=new google.maps.Map(document.getElementById("map"),mapProp);
                }

                function putMarker(lat,lon, especie){
                    var place = new google.maps.LatLng(lat,lon);
                    var marker = new google.maps.Marker({
                            position: place
                            , title: especie
                            , map: mapa
                            , });
                }


                

                function convertDegrees(especie, lat, longtd ){
                    if(lat && longtd){
                        var lati=parseFloat(convertLat(lat));
                        var longi = parseFloat(convertLat(longtd));                        
                        putMarker(lati, longi, especie);
                    }              
                }


                function  convertLat(latd){
                    var sign = latd.charAt(latd.length - 1);
                    var posD,posS, posM ;
                    var degree=0;
                    var minutes=0;
                    var secs=0;
                    var final;
                    posD=latd.indexOf('°');
                    posS=latd.indexOf('\'\'');
                    posM=latd.indexOf('\'');
                    var point=latd.indexOf('.');

                    if (posD!=-1)
                        degree=latd.substring(0,posD);
                    if (posM!=-1){
                        minutes=latd.substring(posD+1,posM);
                        if (posS!=-1)
                            secs=latd.substring(posM+1,posS);
                    }else if(posM==-1 && point!=-1)
                        minutes=latd.substring(posD+1,latd.length-2)

                    if (degree!=0){
                        final=parseFloat(degree);
                        if(minutes!==0){
                            minutes= parseFloat(minutes)/60;
                            final+=minutes;
                            if(secs!=0){
                                secs= parseFloat(secs)/3600;
                                final+=secs;
                            }
                        }   
                    }
                    if (sign=="W" || sign=="S")
                        final="-"+final;
                    return final;

                }
                </script>



</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-expand-toggle">
                        <i class="fa fa-bars icon"></i>
                    </button>
                    <ol class="breadcrumb navbar-breadcrumb">
                        <li>UI Kits</li>
                        <li class="active">Card</li>
                    </ol>
                </div>
            </div>
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <div class="icon fa fa-paper-plane"></div>
                            <div class="title">Flat Admin V.2</div>
                        </a>
                        <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                    </div>
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="index.html">
                                    <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="datatable.php">
                                    <span class="icon fa fa-table"></span><span class="title">Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="map.html">
                                    <span class="icon fa fa-map-marker"></span><span class="title">Map</span>
                                </a>
                            </li>
                            <li>
                                <a href="license.html">
                                    <span class="icon fa fa-thumbs-o-up"></span><span class="title">License</span>
                                </a>
                            </li>
                        </ul>
                </div>
                <!-- /.navbar-collapse -->
                </nav>
            </div>
<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Map</span>
                        <div class="description">Distribution of biological species.</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header"></div>
                                    <div class="card-body">
                                        <div class="row no-margin">
                                            <div class="col-sm-6">
                                                <div class="card primary">
                                                    <div id="map" ></div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-jumbotron">
                                                        <h1>Hello, world!</h1>
                                                        <h3>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</h3>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>                   
        </div>

    <footer class="app-footer">
        <div class="wrapper">
            <span class="pull-right">2.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Copyright.
        </div>
    </footer>
</div>



<?php
function getValues(){
    

    if(($gestor = fopen("Colectas-Amandine.csv", "r"))!==FALSE){
        while (($datos=fgetcsv($gestor, 1000, ",")) !=FALSE){
            if ($datos[3]!="Especie") {
                $x=utf8_encode($datos[8]);
                $y=utf8_encode($datos[9]);

                echo '<script languaje="JavaScript">
                var esp="'.$datos[3].'";
                var lat="'.$x.'";
                var long="'.$y.'";               
                convertDegrees(esp, lat, long);
                </script>';
            }
            
        }
        fclose($gestor);
    }
}
 echo '<script languaje="JavaScript">
initialize();
</script>';

getValues();

?>





    <!-- Javascript Libs -->
    <script type="text/javascript" src="lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="lib/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/js/Chart.min.js"></script>
    <script type="text/javascript" src="lib/js/bootstrap-switch.min.js"></script>

    <script type="text/javascript" src="lib/js/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="lib/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="lib/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/js/select2.full.min.js"></script>
    <script type="text/javascript" src="lib/js/ace/ace.js"></script>
    <script type="text/javascript" src="lib/js/ace/mode-html.js"></script>
    <script type="text/javascript" src="lib/js/ace/theme-github.js"></script>
    <!-- Javascript -->
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/card.js"></script>

</body>
</html>
