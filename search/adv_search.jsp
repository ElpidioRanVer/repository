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
    <title></title>
    
<!-- Javascript Libs -->
    <script type="text/javascript" src="lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="lib/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/js/Chart.min.js"></script>
    <script type="text/javascript" src="lib/js/bootstrap-switch.min.js"></script>

    <script type="text/javascript" src="lib/js/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="lib/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="lib/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/js/ace/ace.js"></script>
    <script type="text/javascript" src="lib/js/ace/mode-html.js"></script>
    <script type="text/javascript" src="lib/js/ace/theme-github.js"></script>
    <!-- Javascript -->
    <script type="text/javascript" src="js/app.js"></script>

<%
String query="select especimen.especimen_id,familia,genero,especie,latitud,longitud,"+
"elevacion,nombre_deposito,num_muestras,adn,sitio,provincia,fecha,nombre,apellido_paterno,apellido_materno,observaciones" +
" from especimen INNER JOIN coordenadas ON (coordenadas.especimen_id=especimen.especimen_id) INNER JOIN "+
"depositos ON (especimen.depositos_deposito_id=depositos.deposito_id) INNER JOIN ubicacion "+
"ON (especimen.especimen_id=ubicacion.especimen_id) INNER JOIN investigadores ON "+
"(especimen.investigadores_investigador_id=investigadores.investigador_id) ";
%>

<script>
var check_status=false;
var querys="";
function create_filter(inpid, sid, num, camp_id){
    var d = document.getElementById(inpid);
    var g = d.checked;
    var div_id;

    if(num==0){
        div_id="test0";
    }else if(num==1){
        div_id="test1";
    }else if(num==2){
        div_id="test2";
    }else if(num==3){
        div_id="test3";
    }else if(num==4){
        div_id="test4";
    }else if(num==5){
        div_id="test5";
    }

    if (g==true) {
        $("#"+sid).load("filter.jsp",{count: num, camp_id: camp_id});
    }else{
        if($("#"+div_id).length){
            $("#"+div_id).remove();
        }
    }
    
}

function adv_browse(count){
    //var val=[];
    var inname,state,svalue;
    var first=true;
    //var val="";
    //var names="";
    for (var i = 0;i<count;i++){
        inname="inswitch"+i;
        svalue="sel"+i;
        state=document.getElementById(inname);
        state=state.checked;
        if(state){
            if (check_status){}else{check_status=true;}
            var vl=document.getElementById(svalue);
            vl = vl.options[ vl.selectedIndex].text;
            //val[i]=vl;
            //val=val+vl+",";
            //names=names+inname+","
            separate_filters(i, vl,first);
            first=false;
        }
    }
    if(check_status==false){
        alert("Sin filtros");
    }
    else{
        if ($("#card_content").length) {$('#card_content').remove();};
        var type_s=2;
        $("#display_results").load("results.jsp",{search_parameters:querys, type_search:type_s});
        $('#searchbox').remove();
        if($("#table_map").length){
            $("#table_map").remove();
        }

    }
    check_status=false;
    querys="";
    //wname="";
    //wval="";
    //$("#table_content").load("adv_content.jsp",{names: names, values: val});   
}

function separate_filters(num, val, first){

    if (first){
        querys +="where ";
    }else{
        querys += "OR ";
    }

    if(num==0){
        querys += "especimen.familia ilike '"+val+"' ";
    }else if(num==1){
        querys += "especimen.genero ilike '"+val+"' ";
    }else if(num==2){
        querys += "especimen.especie ilike '"+val+"' ";
    }else if(num==3){
        querys += "depositos.nombre_deposito ilike '"+val+"' ";
    }else if(num==4){
        querys += "ubicacion.provincia ilike '"+val+"' ";    
    }else if(num==5){
        var name=val.split(",");
        name[0]=name[0].replace(" ","");
        name[1]=name[1].replace(" ","");
        querys += "investigadores.nombre ilike '"+name[1]+"' AND investigadores.apellido_paterno ilike '"+name[0]+"'";
    }
    
}
</script>


</head>
<body>

<form class="form-horizontal" role="form">



<div class="container" id="searchbox">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Seleccionar filtros</div>
            
                <!-- List group -->
                <ul class="list-group">

                <%
                    String sql="select distinct campo,id from campos_interes order by id";
                    Statement stmt = conn.createStatement();
                    ResultSet rs = stmt.executeQuery(sql);
                    int count = 0;
                               
                    while ( rs.next()) {
                                    
                        String campo = rs.getString(1);
                        int camp_id = Integer.parseInt(rs.getString(2));
                        String input_id="inswitch"+count;
                        String select_id="s"+count;%>


                        <li class="list-group-item">
                            <%= campo %>
                            <div class="material-switch pull-right">
                                <input id="<%= input_id %>" name="someSwitchOption001" type="checkbox" onclick="create_filter('<%= input_id %>', '<%= select_id %>', '<%= count %>', '<%= camp_id %>')"/>
                                <label for="<%= input_id %>" class="label-default"></label>
                            </div>
                            <div id="<%= select_id %>"></div>
                        </li>
                        
                
                    <%count++;}rs.close();rs=null;
                    stmt.close();stmt=null;
                    if (conn!=null)
                    conn.close();%>
                </ul>
            </div><a href="#" class="btn btn-primary" role="button" name="browse" onclick="adv_browse('<%= count %>');">Buscar</a>       
        </div>
    </div>
</div>
</form>

</body>
</html>
