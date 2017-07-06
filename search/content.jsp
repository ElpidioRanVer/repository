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
    <title>T</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <!--<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>-->
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

    <!-- Javascript Libs -->
    <script type="text/javascript" src="lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

    <script type="text/javascript" src="lib/js/bootstrap-switch.min.js"></script>

    <script type="text/javascript" src="lib/js/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="lib/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="lib/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/js/select2.full.min.js"></script>
    
    
    
    <!-- Javascript -->
    <script type="text/javascript" src="js/app.js"></script>

    <style>
      #map {
        width: 750px;
        height: 400px;
      }
    </style>


    <script type="text/javascript">
    $(document).ready(function (){
        function downloadCSVfile($table, filename){
            var $rows = $table.find('tr'),

            tmpColDel = String.fromCharCode(11),
            tmpRowDel = String.fromCharCode(0),

            colDel = ',',
            rowDel = '\r\n',

            csv = $rows.map(function(i, row){
                var $row = $(row),
                    $colshead = $row.find('th');
                return $colshead.map(function(j,colhead){
                    var $colhead = $(colhead),
                        text = $colhead.text();
                    return text.replace(/"/g, '""');
                }).get().join(tmpColDel);
            }).get().join(tmpRowDel)
                .split(tmpColDel).join(colDel);

            csv += $rows.map(function(k, row){
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function(l,col){
                    var $col = $(col),
                        text = $col.text();
                    return text.replace(/"/g, '""');
                }).get().join(tmpColDel);
            }).get().join(tmpRowDel)
                .split(tmpRowDel).join(rowDel)
                .split(tmpColDel).join(colDel);

            var csvData = 'data:application/csv;charset=utf-8,'+ encodeURIComponent(csv);

        $(this).attr({
            'download': filename,
            'href': csvData,
            'taget': '_blank'
        });
        }

        $(".btn-success").on('click', function (event){
            downloadCSVfile.apply(this, [$('#table_content'), 'datatable.csv']);
        });        
    });

    function initialize() {
        var mapProp = {
            center:new google.maps.LatLng(19.702688, -101.192188),
            zoom:5,
            mapTypeId:google.maps.MapTypeId.SATELLITE
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

    function convertDegrees(lat, longd, especie){
        if(lat && longd){
            var lati=parseFloat(convertLat(lat));
            var longi = parseFloat(convertLat(longd));                        
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

<%
    String word=request.getParameter("buscar");
    int type_s=Integer.parseInt(request.getParameter("type_search"));

    String search_word=request.getParameter("search_parameters");

    String sql="select especimen.especimen_id,familia,genero,especie,latitud,longitud,"+
"elevacion,nombre_deposito,num_muestras,adn,sitio,provincia,fecha,nombre,apellido_paterno,apellido_materno,observaciones" +
" from especimen INNER JOIN coordenadas ON (coordenadas.especimen_id=especimen.especimen_id) INNER JOIN "+
"depositos ON (especimen.depositos_deposito_id=depositos.deposito_id) INNER JOIN ubicacion "+
"ON (especimen.especimen_id=ubicacion.especimen_id) INNER JOIN investigadores ON "+
"(especimen.investigadores_investigador_id=investigadores.investigador_id) ";

    if(type_s==1){
    sql +="where especimen.genero ilike '"+word+"'"+" OR especimen.familia ilike '"+word+"'"+" OR especimen.especie ilike '"+word+"'";
}else if(type_s==2){
    if (search_word==null || search_word.isEmpty()) {}else{
        sql += search_word;
    }
}

%>

<body>
<script type="text/javascript">initialize();</script>
<div class="col-xs-12" id="table_map">
    <div class="page-title">
        <span class="title">Registros</span>
        <br>
    </div>
                            <div class="card">
                                <div class="card-header">

                                    <div class="card-title">
                                    <div class="title">
                                    <%if (type_s ==1){out.print(word);}else{
                                        out.print("Búsqueda Avanzada");
                                    }  %>
                                    </div>
                                    </div>
                                </div>
                                <div class="card-body" style="overflow:auto;">
                                    <table class="datatable table table-striped" id="table_content" cellspacing="0" width="100%">
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
                                        <tbody>
                                            
						<%
                        
						Statement stmt = conn.createStatement();
     						ResultSet rs = stmt.executeQuery(sql);

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
        <td><%= especie %></td>
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
        <script type="text/javascript">convertDegrees("<%= latitud %>","<%= longitud %>","<%= especie %>");</script>
                                <%}rs.close();rs=null;
     stmt.close();stmt=null;
     if (conn!=null)
     conn.close();%>

                                            </tbody>
                                    </table>
                                </div><a href="#" class="btn-success">Descargar tabla</a>
                            </div>
                            <br><br><br>
                            <div class="page-title">
                                <span class="title">Distribución</span>
                            </div>
                            <br><div id="map" ></div>
                        </div>
                   
</body>
</html>
