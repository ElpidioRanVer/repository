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

<script src="http://maps.googleapis.com/maps/api/js"></script>

    <script type="text/javascript">
    </script>


</head>
<body>
<%
    String slid=request.getParameter("select_id");
    String vlid=request.getParameter("svalue");
    String column1= request.getParameter("column1");
    String column2= request.getParameter("column2");
    String tab= request.getParameter("table");

    String sql="select distinct "+column2+"  from "+tab+"  where "+column1+"='"+vlid+"' order by "+column2;
    Statement stmt = conn.createStatement();
    ResultSet rs = stmt.executeQuery(sql);%>


    <select class="form-control" id="<%= slid%>">

        <%while ( rs.next()) {
            String campo = rs.getString(1); %>
            <option value=""><%= campo %></option> 
        <%}rs.close();rs=null; stmt.close();stmt=null;%>
    </select>

</body>
</html>
