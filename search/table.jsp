<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.sql.*" %>
<%
   String driver="org.postgresql.Driver";
   String url="jdbc:postgresql://localhost/colectap";

    Class.forName(driver);
   Connection conn=null;
%>

<%

     conn = DriverManager.getConnection(url,"colecta","colecta");
     
%>

<!DOCTYPE html>
<html>

<head>
    <title>Data Base</title>
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
                            <li>Table</li>
                            <li class="active">Datatable</li>
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
                                <a href="map.php">
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
                        <span class="title">Datatable</span>
                        <div class="description">with jquery Datatable for display data with most usage functional. such as search, ajax loading, pagination, etc.</div>
                        <form method="post">
                            <select name="campo" id="campo">
                            <?php
                                $connection=odbc_connect('ClouderaODBC','','');
                                $SQL_Exec_String="show column stats biological_species";
                                $result=odbc_exec($connection, $SQL_Exec_String);
                                while ( $Tables=odbc_fetch_array($result)) {
                                    if (substr($Tables['Column'], 0,6)!='numero') {
                                        echo "<option>".$Tables['Column']."</option>";
                                    }
                                }
                            ?>

			<%
				String sql="select distinct genero from especimen order by genero";
				Statement stmt = conn.createStatement();
     				ResultSet rs = stmt.executeQuery(sql);
				while ( rs.next()) {
					String specie = rs.getString(1);%>
                                        <option><%= specie %></option>

                                <%}%>
				
				
                            </select>
                            <br>
                                <select id="sub" name="sub" style="width : 165px"></select>
                                <br>
                            <button type="submit" name="boton"> Consulta</button>
				            <button name="distribution"> Distribucion</button>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">

                                    <div class="card-title">
                                    <div class="title">Table</div>
                                    </div>
                                </div>
                                <div class="card-body" style="overflow:auto;">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
    						<th>Familia</th>
    						<th>Genero</th>
    						<th>Especie</th>
    						<th>Latitud</th>
    						<th>Longitud</th>
    						<th>Elevación</th>
    						<th>Deposito</th>
    						<th>No. muestras</th>
    						<th>ADN</th>
    						<th>Sitio</th>
    						<th>Provincia</th>
    						<th>Fecha</th>
    						<th>Investigador</th>
    						<th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
    						<th>Familia</th>
    						<th>Genero</th>
    						<th>Especie</th>
    						<th>Latitud</th>
    						<th>Longitud</th>
    						<th>Elevación</th>
    						<th>Deposito</th>
    						<th>No. muestras</th>
    						<th>ADN</th>
    						<th>Sitio</th>
    						<th>Provincia</th>
    						<th>Fecha</th>
    						<th>Investigador</th>
    						<th>Observaciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
						<%
						sql="select especimen.especimen_id,familia,genero,especie,latitud,longitud,"+
"elevacion,nombre_deposito,num_muestras,adn,sitio,provincia,fecha,nombre,apellido_paterno,apellido_materno,observaciones" +
" from especimen INNER JOIN coordenadas ON (coordenadas.especimen_id=especimen.especimen_id) INNER JOIN "+
"depositos ON (especimen.depositos_deposito_id=depositos.deposito_id) INNER JOIN ubicacion "+
"ON (especimen.especimen_id=ubicacion.especimen_id) INNER JOIN investigadores ON "+
"(especimen.investigadores_investigador_id=investigadores.investigador_id)";
						stmt = conn.createStatement();
     						rs = stmt.executeQuery(sql);

						while(rs.next()) {
String id = rs.getString(1);
       String familia = rs.getString(2);
       String genero = rs.getString(3);
       String especie = rs.getString(4);
       String latitud = rs.getString(5);
       String longitud = rs.getString(6);
       String elevacion = rs.getString(7);
       String dep = rs.getString(8);
       String num = rs.getString(9);
       String adn = rs.getString(10);
       String sitio = rs.getString(11);
       String prov = rs.getString(12);
       String fecha = rs.getString(13);
       String inv = rs.getString(14)+" "+rs.getString(15);
       String obs = rs.getString(17);%>
					
						<tr><td><%= id %></td>
        <td><%= familia %></td>
        <td><%= genero %></td>
        <td><%= especie %>
        <td><%= latitud %></td>
        <td><%= longitud %></td>
        <td><%= elevacion %></td>
        <td><%= dep %></td>
        <td><%= num %></td>
        <td><%= adn %></td>
        <td><%= sitio %></td>
        <td><%= prov %></td>
        <td><%= fecha %></td>
        <td><%= inv %></td>
        <td><%= obs %></td></tr>
                                <%}rs.close();rs=null;
     stmt.close();stmt=null;
     if (conn!=null)
     conn.close();%>

                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
		    <!--<div id="map" ></div>-->
                </div>
            </div>	
        </div>


	<br><br>

        <footer class="app-footer">
            <div class="wrapper">
                <span class="pull-right">2.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Copyright.
            </div>
        </footer>
    <div>


<?php
function getValues(){
    $val=htmlentities($_POST['sub'],ENT_QUOTES,"UTF-8"); 
    $column=htmlentities($_POST['campo'],ENT_QUOTES,"UTF-8");
    $campo;

    switch ($column) {
            case 'familia':
                $campo=1;
                break;
            case 'genero':
                $campo=2;
                break;
            case 'especie':
                $campo=3;
                break;
            case 'identifica':
                $campo=4;
                break;
            case 'fecha':
                $campo=5;
                break;
            case 'sitio':
                $campo=6;
                break;
            case 'provincia':
                $campo=7;
                break;
            case 'latitud':
                $campo=8;
                break;
            case 'longitud':
                $campo=9;
                break;
            case 'elevacion':
                $campo=10;
                break;
            case 'no_muestras':
                $campo=11;
                break;
            case 'adn':
                $campo=12;
                break;
            case 'especimen_depositado_en':
                $campo=13;
                break;
            case 'observaciones':
                $campo=14;
                break;
            case 'colectado_con':
                $campo=15;
                break;
        }    

    if(($gestor = fopen("Colectas-Amandine.csv", "r"))!==FALSE){
        while (($datos=fgetcsv($gestor, 1000, ",")) !=FALSE){
            if ($datos[$campo]==$val) {
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
?>
<?php
if (isset($_POST['boton'])) {
	getValues();
}
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
    <script>
        $( "#campo" ).change(function () {
            $( "#campo option:selected" ).each(function() {
                Column = $(this).val();
                $.post("sub.php", { Column: Column }, function(data){
                    $("#sub").html(data);
                });    
            });
        })
    .change();
    </script>
</body>

</html>
