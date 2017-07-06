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
    String word=request.getParameter("buscar");
    int type_s=Integer.parseInt(request.getParameter("type_search"));
    String search_word=request.getParameter("search_parameters");

    String sql="select distinct familia,genero,especie"+
" from especimen INNER JOIN "+
"depositos ON (especimen.depositos_deposito_id=depositos.deposito_id) INNER JOIN ubicacion "+
"ON (especimen.especimen_id=ubicacion.especimen_id) INNER JOIN investigadores ON "+
"(especimen.investigadores_investigador_id=investigadores.investigador_id) ";

    if(type_s==1){
    if(word==null || word.isEmpty()){}else{
        sql +="where genero ilike '"+word+"'"+" OR familia ilike '"+word+"'"+" OR especie ilike '"+word+"'";
    }
}else if(type_s==2){
    if (search_word==null || search_word.isEmpty()) {}else{
        sql += search_word;
    }
}
%>


    <script type="text/javascript">
    function show_table(){
        if($("#table_map").length){$('#table_map').remove();}
        
        
            if(<%= type_s %>==1){
                $("#table_content").load("content.jsp",{buscar:"<%= word %>", type_search:<%= type_s %>});
                //alert(stype +" "+word);
            }
        else if(<%= type_s %>==2){
            $("#table_content").load("content.jsp",{search_parameters:"<%= search_word%>", type_search:<%= type_s %>});
            $('#searchbox').remove();
        }
        $('#searchbox').remove();
        $('#card_content').remove();
    }
    </script>


</head>
<body>

<div id="card_content">
<%
    Statement stmt = conn.createStatement();
    ResultSet rs = stmt.executeQuery(sql);
    while(rs.next()){
        String familia = rs.getString(1);
        String genero = rs.getString(2);
        String especie = rs.getString(3);
    %>
    <div class="card">
        <h3 class="card-header"><%= familia %></h3>
        <div class="card-block">
            <h4 class="card-tittle"><%= genero %> / <%= especie %></h4>
            <p class="card-text">Descripción</p>
            <a href="#" class="btn btn-success" onclick="show_table();">Más</a>
        </div>
    </div>
    <br><br>

    <%}rs.close();rs=null;
     stmt.close();stmt=null;
     if (conn!=null)
     conn.close();%>

            
</div>
</body>
</html>
