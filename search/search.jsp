<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.sql.*" %>




<!DOCTYPE html>
<html>

<head>
    <title>Catálogo</title>
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
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <link rel="stylesheet" type="text/css" href="css/themes/flat-blue.css">
    <link rel="stylesheet" type="text/css" href="css/switch.css">
    <link rel="stylesheet" type="text/css" href="css/structure.css">

    <style>
      #map {
        width: 700px;
        height: 450px;
      }

    </style>


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
<script src="http://maps.googleapis.com/maps/api/js"></script>

<script type="text/javascript">

$(function(){
    $("#keyword").keyup(function(e){
        if (e.which == 13){
            show_results();
        }
    });
});

        
  

		function show_adv(){
            if($("#searchbox").length){
                $('#searchbox').remove();
            }else{
                $("#advanced_box").load("adv_search.jsp");
            }
			
		}

		function show_table(){
            if($("#table_map").length){$('#table_map').remove();}
			var search_word=document.getElementById("keyword").value;
            var type_s=1;
			if(search_word!=""){
				$("#table_content").load("content.jsp",{buscar:search_word, type_search:type_s});
			}else{
				alert("Campo vacio..");
			}
            $('#searchbox').remove();
		}

        function show_results(){
            if ($("#card_content").length) {$('#card_content').remove();};
            if($("#table_map").length){
                $("#table_map").remove();
            }
            
            var search_word=document.getElementById("keyword").value;
            var type_s=1;
            if(search_word!=""){
                $("#display_results").load("results.jsp", {buscar: search_word, type_search: type_s});
            }else{
                alert("Campo vacio..");
            }
            $('#searchbox').remove();
            
        }            
</script>
</head>



<body class="flat-blue">
    <div id ="sup">
        <div id="logo">
            <img class="img_logo" src="img/lanase-logo.png">
        </div>
        <div id="logo2">
            <img class="img_logo" src="img/logo-enes.png">
            <img class="img_logo" src="img/logo-uagro.png">
            <img class="img_logo" src="img/logo-conacyt.png">
        </div>
    </div>
    <div id="central">
        <div id="left_pan">
            <div class="input-group stylish-input-group">
                <input type="text" id="keyword"  class="form-control"  placeholder="Buscar.." >
                <span class="input-group-addon">
                    <button onclick= "show_results()">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>  
                </span>
            </div>
                     

            <br><br>
            <div id="advanced_box" ></div>
            <br>
            <div style="width:100px; margin:0 auto;">
                <a href="#" class="btn btn-primary" role="button" onclick= "show_adv()"name="hide_show">Búsqueda Avanzada</a>
            </div>
        </div>
        <div id="center_pan">
            <div class="margen">
                <div class="app-container">
            <!-- Main Content -->
                    <div class="container-fluid">
                        <div class="side-body">
                            <div class="row" id="table_content"></div>
                        <br><br>
                        </div>
                    </div>
                </div>
                <div id="display_results"></div>
            </div>
            
        </div>
    </div>

    <div id="inf_pan">
        <footer class="app-footer">
            <div class="wrapper">
                <span class="pull-right">2.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Copyright.
            </div>
        </footer>
    </div>
</body>

</html>
