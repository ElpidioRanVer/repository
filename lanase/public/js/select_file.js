var load_flag=0;



  function rm_data(){
    if(confirm("Desea limpiar los registros?")){
      var cont=document.getElementById("test");
      if(cont){
        cont.remove();
      }
    }
  }

//It verifies that there are information to send... 

  function send_info(){
    if(document.getElementById("table_content")){
      //read_table();
      console.log("ok");
    }else{
      console.log("No hay registros");
    }
    
  }

//Send the table to store it into Data Base
  function save_content(arr_cont,arr_size){
    var json_arr = JSON.stringify(arr_cont);
    var dat = new FormData();
    dat.append( 'arr_data', json_arr );
    dat.append( 'arr_size', arr_size );

    $.ajax({
      type:'post',
      url:'save_info.php',
      data: dat,
      contentType: false,
      processData: false,
      success: function(result){
      }
    });
  }

  function handleFiles(files) {
      // Check for the various File API support.
      if ($("#files").val()!="") {
          if (window.FileReader) {
              // FileReader are supported.
              if(files){getAsText(files[0]);}
          } else {
              alert('FileReader are not supported in this browser.');
          }
    }
    }

    function getAsText(fileToRead) {
      var reader = new FileReader();
      // Read file into memory as UTF-8      
      reader.readAsText(fileToRead);

      // Handle errors load
      reader.onload = loadHandler;
      reader.onerror = errorHandler;
    }

    function loadHandler(event) {
      var csv = event.target.result;
      processData(csv);
      $("#files").val("");
    }



    //Split file´s content delimited with "," and create a table.

    function processData(csv) {
      var allTextLines = csv.split(/\r\n|\n/);
      var fields = [];
      var content = [];
        
      for (var i=0; i<allTextLines.length; i++) {
        var data = allTextLines[i].split(',');
        
        for (var j=0; j<data.length; j++) {
          if (i==0) {
            //Here there are the field´s name
            fields[j]=data[j];
          }else{
            content[i-1]+=data[j]+',';
          }  
        }    
      }

      var json_fields = JSON.stringify(fields);
      var json_content = JSON.stringify(content);
      var dat = new FormData();
      var aux=$("#pruba").attr("content");
      

      
      dat.append( 'arr_fields', json_fields );
      dat.append( 'arr_content', json_content );
      dat.append( 'token_val', aux );

      $.ajax({
        type:'post',
        url:'../resources/views/taxonomic/create_table.php',
        data: dat,
        contentType: false,
        processData: false,
        success: function(result){
          $("#result_info").html(result);
          check_if_exist(content.length);
        }
      });

    }




    function errorHandler(evt) {
      if(evt.target.error.name == "NotReadableError") {
          alert("Canno't read file !");
      }
    }


    //Get the content and save it into an Array named "rowArr"

    function read_table(){
      var el1="#table_content tr"

      // Get the number of rows less row of column´s titles
      var n=get_size(el1)-1;

      //Create a new array and initialize it with empty strings
      var rowArr = clear_array(n);
      var i=0;

      //In the firs regiter of the Array it stores the name of the columns
      $('#table_content tr th').each(function(){
        rowArr[0]+=$(this).text()+",";
      });

      //Save the content of the "td" element
      $('#table_content tr td').each(function(){
        var  x=parseInt($(this).attr('id'));
        rowArr[x]+=$(this).text()+",";
        i++;
      });
      /*for (var i = 0; i < rowArr.length; i++) {
        console.log(rowArr[i]);
      }*/
      save_content(rowArr,rowArr.length);
    }



    function get_size(search_cont){
      var arr_size=0;
      $(search_cont).each(function(){
        arr_size++;
      });
      return arr_size;
    }



    function clear_array(arr_size){
      var arr=[];
      for (i=0; i<=arr_size;i++){
        arr.push("");
      }
      return arr;
    }

    function readGaleria(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }

}

    function check_if_exist(no_rows){
      var genus, specie, subspecie;

      for (var i = 0; i < no_rows; i++) {
        genus = $("#"+i+"0").text();
        specie = $("#"+i+"1").text();
        subspecie = $("#"+i+"2").text();

        if (genus && specie) {
          var name= genus+"+"+specie;
          if (subspecie) {
            name += "+"+subspecie;
          }
        }

        var dat = new FormData();
        dat.append( 'sc_name', name );
        dat.append('no_row', i);

        $.ajax({
          type:'post',
          url:'../resources/views/taxonomic/check_taxid.php',
          data: dat,
          contentType: false,
          processData: false,
          success: function(result){
            $("#check_id").html(result);
          }
        });
      }
    }

    function print_if_exists(valn,nRow){
      if(valn==false){
        document.getElementById("tr"+nRow).setAttribute("class", "tr_red");
        //console.log("NO encontrado");
      }
    }

    function taxonomic_form(no_row,genus,specie,lat,long,subspecie){

      if (genus && specie) {
        var name= genus+"+"+specie;
        if (subspecie) {
          name += "+"+subspecie;
        }
      }
      
      if (lat && long) {
        if(lat.indexOf('°') > -1){
          lat = convertLat(lat);
        } 
        
        if(long.indexOf('°') > -1){
          long = convertLat(long);
        }

        var coords = lat + "%2C" + long;
      }
      

      if (name) {
        var dat = new FormData();
        dat.append( 'sc_name', name );
        dat.append('no_row', no_row);

        if (coords){
          dat.append( 'coordinates', coords );
        }

        load_flag++;

        $.ajax({
          type:'post',
          url:'../resources/views/taxonomic/getTaxonomicForm.blade.php',
          data: dat,
          contentType: false,
          processData: false,
          success: function(result){
            $("#div_taxt"+no_row).append(result);
            check_load(); //Funtion for wait until the page is loaded.
          }
        });
      }
    }

    function check_load(){
      load_flag--;
      if (load_flag==0) {
        $("#btn_save").removeClass("hidden");
      }
    }

    function more_info(id_row){
      var genus = $("#"+id_row+"0").text();
      var specie = $("#"+id_row+"1").text();
      var subspecie = $("#"+id_row+"2").text();
      var lat = $("#"+id_row+"3").text();
      var lon = $("#"+id_row+"4").text();
      
      if (lat && lon) {
        if(lat.indexOf('°') > -1){
          lat = convertLat(lat);
        } 
        
        if(lon.indexOf('°') > -1){
          lon = convertLat(lon);
        }

        var coords = lat + "%2C" + lon;
        console.log(id_row+" "+coords);
      }

      if (genus && specie) {
        var name= genus+"+"+specie;
        if (subspecie) {
          name += "+"+subspecie;
        }
      }
      

      if (name) {
        var dat = new FormData();
        dat.append( 'sc_name', name );

        if (coords){
          dat.append( 'coordinates', coords );
        }

        $.ajax({
          type:'post',
          url:'../resources/views/taxonomic/getTaxonomy.php',
          data: dat,
          contentType: false,
          processData: false,
          success: function(result){
            if ($("#delete").length==0) 
              $("<br><button id='delete' class='btn btn-default btn-sm' onclick='show_tax(this.title)' title='tax_content'>Cerrar</button>").appendTo($("#tax_content"));
            $("#tax_info").html(result);
            show_tax("tax_content");

          }
        });
      }
    }


    function show_tax(id){
      if($("#"+id).hasClass("abrir")){
        $("#"+id).removeClass("abrir");
        $(".sombra").removeClass("abrir");
      }else{
        $("#"+id).addClass("abrir");
        $(".sombra").addClass("abrir");
      } 
    }


    function select_images(id){
      if($("#hiden"+id).hasClass("abrir")){
        $("#hiden"+id).removeClass("abrir");
        $(".sombra").removeClass("abrir");
      }else{
        $("#hiden"+id).addClass("abrir");
        $(".sombra").addClass("abrir");
      } 
    }



function prevImages(input, id, div){
  $("#"+div).html("");
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e, id) {
          
            $('#pruba'+id).attr('src', e.target.result);
        }
        for(var x=0;input.files.length>x;x++){
          if(input.files[x].type.match('image.*')){
            if(input.files[x].size < 2097152){ 
              var reader = new FileReader();
              reader.addEventListener("load",function(event){
                var picFile = event.target;
                $("#"+div).append("<img src='"+picFile.result+"' id='pruba"+x+"'/>");           
              }); 
              reader.readAsDataURL(input.files[x]);
            }
          }
        }

      }
  }


  function  convertLat(latd){
      latd=latd.replace(" ","");
      latd=latd.replace("\'\'",'"');

      var dir;
      var g="";
      var m="";
      var s="";

      if (latd.indexOf("N")!=-1) {
        dir="N";
        latd=latd.replace("N","")
      }else if (latd.indexOf("S")!=-1) {
        dir="S";
        latd=latd.replace("S","")
      }else if (latd.indexOf("W")!=-1) {
        dir="W";
        latd=latd.replace("W","")
      }else if (latd.indexOf("E")!=-1) {
        dir="E";
        latd=latd.replace("E","")
      }

     
      if (latd.indexOf("°")!=-1) {
        var aux = latd.substring(0,latd.indexOf("°"));
        //console.log("grados "+aux);
        g=aux;
      }

      if (latd.indexOf("\'")!=-1) {
        var aux = latd.substring(latd.indexOf("°")+1,latd.indexOf("\'"));
        //console.log("min "+aux);
        m=aux;

      }

      if (latd.indexOf('\"')!=-1) {
        var aux = latd.substring(latd.indexOf("\'")+1,latd.indexOf('\"'));
        //console.log("seg "+aux);
        s=aux;
      }
      var pruba=latd.replace(g+"°","");
      pruba=pruba.replace(m+"\'","");
      var m2=pruba.replace(s+'\"',"");


      if (g!=0){
          final=parseFloat(g);
      }

      if(m!=0){
        m= parseFloat(m)/60;
        final+=m;     
      }

      if(m2!=0){
        m2= parseFloat(m2)/60;
        final+=m2;     
      }

      if(s!=0){
        s= parseFloat(s)/3600;
        final+=s;
      }


      if (dir=="W" || dir=="S")
          final="-"+final;
      return final;

/*
      var sign = latd.charAt(latd.length - 1);
      var posD,posS, posM;
      var degree=0;
      var minutes=0;
      var secs=0;
      var final;
      

      posS=latd.indexOf('\'\'');
      
      var point=latd.indexOf('.');

      if (latd.indexOf('°')) {
        posD=latd.indexOf('°');
      }

      if (latd.indexOf('\'')!=-1) {
        posM=latd.indexOf('\'');
      } else{
        posM = latd.length-2;
      }







      
      if (posD!=-1){
          degree=latd.substring(0,posD);
          //console.log(degree);

        }
      if (posM!=-1){
          minutes=latd.substring(posD+1,posM);
          //console.log("minutes: "+minutes);
                        
      }if (posS!=-1){
            secs=latd.substring(posM+1,posS);
            //console.log("seconds: "+secs);
      }else if(latd.indexOf('\"')!= -1){
        secs=latd.substring(posM+1,latd.indexOf('\"'));
        //console.log("seconds: "+secs);
      }
      else if(posM==-1 && point!=-1)
          minutes=latd.substring(posD+1,latd.length-2)
      */
      

  }