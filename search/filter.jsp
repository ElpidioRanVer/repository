
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

    <script type="text/javascript">
    </script>


</head>
<body>
<%
    String count=request.getParameter("count");
    String div_id="test"+count;
    String slid="sel"+count;
    int camp_id=Integer.parseInt(request.getParameter("camp_id"));%>


<div id="<%= div_id %>">
    <select class="form-control" id="<%= slid%>">
      <%        String tab;
                String col;
                if(camp_id==1){                 
                    tab="especimen";
                    col="familia";
                }else if(camp_id==2){                   
                    tab="especimen";
                    col="genero";
                }else if(camp_id==3){                   
                    tab="especimen";
                    col="especie";
                }else if(camp_id==4){                   
                    tab="depositos";
                    col="nombre_deposito";
                }else if(camp_id==5){                   
                    tab="ubicacion";
                    col="provincia";
                }else{
                    
                    tab="investigadores";
                    col="apellido_paterno, nombre";
                }
                String sql2;
                Boolean full_name=false;
                if (col=="apellido_paterno, nombre"){
                    sql2="select "+col+" from "+tab+" order by apellido_paterno";
                    full_name=true;
                }else{sql2="select distinct "+col+" from "+tab+" order by "+col;}
                Statement stmt = conn.createStatement();
                    ResultSet rs2 = stmt.executeQuery(sql2);
                
                while ( rs2.next()) {
                    String val;
                    if(full_name==true){val = rs2.getString(1)+", "+rs2.getString(2);}else{
                    val = rs2.getString(1);}%>
                    <option value=""><%= val %></option><%} rs2.close();rs2=null; stmt.close();stmt=null;
    if (conn!=null)
    conn.close();%>
                                
                           

    </select>
</div>

</body>
</html>

