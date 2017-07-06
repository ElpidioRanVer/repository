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
    </script>
    </script>


</head>
<body>
<%
    String search_word=request.getParameter("search_parameters");

    String sql="select especimen.especimen_id,familia,genero,especie,latitud,longitud,"+
"elevacion,nombre_deposito,num_muestras,adn,sitio,provincia,fecha,nombre,apellido_paterno,apellido_materno,observaciones" +
" from especimen INNER JOIN coordenadas ON (coordenadas.especimen_id=especimen.especimen_id) INNER JOIN "+
"depositos ON (especimen.depositos_deposito_id=depositos.deposito_id) INNER JOIN ubicacion "+
"ON (especimen.especimen_id=ubicacion.especimen_id) INNER JOIN investigadores ON "+
"(especimen.investigadores_investigador_id=investigadores.investigador_id) ";

    if (search_word==null || search_word.isEmpty()) {}else{
        sql += search_word;
        out.print(sql);
    }
%>

</body>
</html>
