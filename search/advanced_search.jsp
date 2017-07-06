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
    
<!-- Javascript Libs -->
    

    <script type="text/javascript">
    function display(x){
    	var svalue=document.getElementById(x);
    	var col2,col1,tab,did;
    	svalue = svalue.options[ svalue.selectedIndex].text;
    	if (x=='s0'){
    		col1="familia"
    		col2="genero";
    		tab="especimen";
    		did="#d1"
    		$(did).load("query.jsp",{select_id: "s1", svalue: svalue, column2: col2, column1: col1, table: tab});
    		
    	}else if(x=='s1'){
    		col1="genero"
    		col2="especie";
    		tab="especimen";
    		did="#d2"
    		$(did).load("query.jsp",{select_id: "s2", svalue: svalue, column2: col2, column1: col1, table: tab});
    	}
    	
    	
    }

    function subSelect(sid, svalue1){
    	<%
    	String name=request.getParameter("xa");
		%>
     	var select=document.getElementById(sid);
	    var y="#"+sid;
	    $(y).empty();
		select.options[select.options.length]= new Option(svalue1);
		
	}

	function lol(svalue){
		$.ajax({
    		type: "POST",
    		url: 'query.jsp',
    		data: {'xa': "Convolvulaceae"},
    	});
	}

    </script>


</head>
<body>
<div class="well-searchbox" id="searchbox">
<form class="form-horizontal" role="form">
<%
				String sql="select distinct campo,id from campos_interes order by id";
				Statement stmt = conn.createStatement();
     			ResultSet rs = stmt.executeQuery(sql);
     			int count = 0;
				while ( rs.next()) {
					
					String campo = rs.getString(1);
					int camp_id = Integer.parseInt(rs.getString(2));
					String select_id="s"+count;
					String sel_div="d"+count;%>
                    

                                                  
                    <div class="form-group">
                        <div><label class="col-md-4 control-label"><%= campo %></label></div>
                        <div class="col-md-8" id="<%= sel_div %>">
                            <select class="form-control" id="<%= select_id %>" onchange="if (this.selectedIndex) display('<%= select_id %>');">
<%				String tab;
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
					col="nombre, apellido_paterno";
				}
				String sql2;
				Boolean full_name=false;
				if (col=="nombre, apellido_paterno"){
					sql2="select "+col+" from "+tab+" order by nombre";
					full_name=true;
				}else{sql2="select distinct "+col+" from "+tab+" order by "+col;}
				stmt = conn.createStatement();
     				ResultSet rs2 = stmt.executeQuery(sql2);%>
				
				<option value=""></option>
				<%while ( rs2.next()) {
					String val;
					if(full_name==true){val = rs2.getString(1)+" "+rs2.getString(2);}else{
					val = rs2.getString(1);}%>
                                <option value=""><%= val %></option><%} rs2.close();rs2=null;%>
                                
                            </select>
                        </div>
                    </div>
<%count++;}rs.close();rs=null;
	stmt.close();stmt=null;
	if (conn!=null)
	conn.close();%>               
                    <div class="col-sm-offset-4 col-sm-5">
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                </form>
</div>
</body>
</html>
