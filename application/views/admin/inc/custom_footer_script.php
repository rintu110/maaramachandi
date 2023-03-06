<script src='<?=base_url()?>assets/js/autosize.js'></script>
<script src="<?=base_url();?>assets/js/imgareaselect.js"></script> 
<script type="text/javascript">
   autosize(document.querySelectorAll('textarea'));
  
    function mytext(vals,ids)
    {
       var string = vals.replace(/  +/g, ' ');
       $('#'+ids).val(string);
    }   

    function makeurl(vals) 
    {
        var hd = vals.trim();
        var newhd = hd.replace(/[.]/gi, '').toLowerCase();
        var urls = newhd.replace(/[^a-z0-9]/gi, '-').toLowerCase();
        var url = urls.replace(/[\. ,:-]+/g, "-");
        $('#slug_url').val(url);
    }

    // Set image coordinates
    function updateCoords(im,obj){
        var img = document.getElementById("imagePreview");
        var orgHeight = img.naturalHeight;
        var orgWidth = img.naturalWidth;
      
        var porcX = orgWidth/im.width;
        var porcY = orgHeight/im.height;
      
        $('input#x').val(Math.round(obj.x * porcX));
        $('input#y').val(Math.round(obj.y * porcY));
        $('input#w').val(Math.round(obj.width * porcX));
        $('input#h').val(Math.round(obj.height * porcY));
    }

    // Set image coordinates
    function updateCoords1(im,obj){
        var img = document.getElementById("imagePreview1");
        var orgHeight = img.naturalHeight;
        var orgWidth = img.naturalWidth;
      
        var porcX = orgWidth/im.width;
        var porcY = orgHeight/im.height;
      
        $('input#x1').val(Math.round(obj.x1 * porcX));
        $('input#y1').val(Math.round(obj.y1 * porcY));
        $('input#w1').val(Math.round(obj.width * porcX));
        $('input#h1').val(Math.round(obj.height * porcY));
    }

     // Set image coordinates
    function updateCoords2(im,obj){
        var img = document.getElementById("imagePreview2");
        var orgHeight = img.naturalHeight;
        var orgWidth = img.naturalWidth;
      
        var porcX = orgWidth/im.width;
        var porcY = orgHeight/im.height;
      
        $('input#x2').val(Math.round(obj.x2 * porcX));
        $('input#y2').val(Math.round(obj.y2 * porcY));
        $('input#w2').val(Math.round(obj.width * porcX));
        $('input#h2').val(Math.round(obj.height * porcY));
    }

     // Set image coordinates
    function updateCoords3(im,obj){
        var img = document.getElementById("imagePreview3");
        var orgHeight = img.naturalHeight;
        var orgWidth = img.naturalWidth;
      
        var porcX = orgWidth/im.width;
        var porcY = orgHeight/im.height;
      
        $('input#x3').val(Math.round(obj.x3 * porcX));
        $('input#y3').val(Math.round(obj.y3 * porcY));
        $('input#w3').val(Math.round(obj.width * porcX));
        $('input#h3').val(Math.round(obj.height * porcY));
    }

     // Set image coordinates
    function updateCoords4(im,obj){
        var img = document.getElementById("imagePreview4");
        var orgHeight = img.naturalHeight;
        var orgWidth = img.naturalWidth;
      
        var porcX = orgWidth/im.width;
        var porcY = orgHeight/im.height;
      
        $('input#x4').val(Math.round(obj.x4 * porcX));
        $('input#y4').val(Math.round(obj.y4 * porcY));
        $('input#w4').val(Math.round(obj.width * porcX));
        $('input#h4').val(Math.round(obj.height * porcY));
    }

     // Set image coordinates
    function updateCoords5(im,obj){
        var img = document.getElementById("imagePreview4");
        var orgHeight = img.naturalHeight;
        var orgWidth = img.naturalWidth;
      
        var porcX = orgWidth/im.width;
        var porcY = orgHeight/im.height;
      
        $('input#x5').val(Math.round(obj.x5 * porcX));
        $('input#y5').val(Math.round(obj.y5 * porcY));
        $('input#w5').val(Math.round(obj.width * porcX));
        $('input#h5').val(Math.round(obj.height * porcY));
    }


    $(document).ready(function(){

      var _URL = window.URL || window.webkitURL;

      // Prepare instant image preview
      var p = $("#imagePreview");
      $("#fileInput").change(function(){

          var file = $(this)[0].files[0];

          img = new Image();
          var imgwidth = 0;
          var imgheight = 0;          

          img.src = _URL.createObjectURL(file);
          img.onload = function() {
             imgwidth = this.width;
             imgheight = this.height;

             $('#x').val(1);
             $('#y').val(1);
             $('#w').val(imgwidth);
             $('#h').val(imgheight);
          }         
         
          //fadeOut or hide preview
          p.fadeOut();         
      
          //prepare HTML5 FileReader
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("fileInput").files[0]);
      
          oFReader.onload = function(oFREvent){
              p.attr('src', oFREvent.target.result).fadeIn();
          };         
      });

      // Prepare instant image preview
      var p1 = $("#imagePreview1");
      $("#fileInput1").change(function(){

          var file = $(this)[0].files[0];

          img = new Image();
          var imgwidth = 0;
          var imgheight = 0;          

          img.src = _URL.createObjectURL(file);
          img.onload = function() {
             imgwidth = this.width;
             imgheight = this.height;

             $('#x1').val(1);
             $('#y1').val(1);
             $('#w1').val(imgwidth);
             $('#h1').val(imgheight);
          }         
         
          //fadeOut or hide preview
          p1.fadeOut();         
      
          //prepare HTML5 FileReader
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("fileInput1").files[0]);
      
          oFReader.onload = function(oFREvent){
              p1.attr('src', oFREvent.target.result).fadeIn();
          };         
      });

      // Prepare instant image preview
      var p2 = $("#imagePreview2");
      $("#fileInput2").change(function(){
        
           var file = $(this)[0].files[0];

          img = new Image();
          var imgwidth = 0;
          var imgheight = 0;          

          img.src = _URL.createObjectURL(file);
          img.onload = function() {
             imgwidth = this.width;
             imgheight = this.height;

             $('#x2').val(1);
             $('#y2').val(1);
             $('#w2').val(imgwidth);
             $('#h2').val(imgheight);
          }         
         
          //fadeOut or hide preview
          p2.fadeOut();         
      
          //prepare HTML5 FileReader
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("fileInput2").files[0]);
      
          oFReader.onload = function(oFREvent){
              p2.attr('src', oFREvent.target.result).fadeIn();
          };         
      });


       // Prepare instant image preview
      var p3 = $("#imagePreview3");
      $("#fileInput3").change(function(){        

          var file = $(this)[0].files[0];

          img = new Image();
          var imgwidth = 0;
          var imgheight = 0;          

          img.src = _URL.createObjectURL(file);
          img.onload = function() {
             imgwidth = this.width;
             imgheight = this.height;

             $('#x3').val(1);
             $('#y3').val(1);
             $('#w3').val(imgwidth);
             $('#h3').val(imgheight);
          }         
         
          //fadeOut or hide preview
          p3.fadeOut();         
      
          //prepare HTML5 FileReader
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("fileInput3").files[0]);
      
          oFReader.onload = function(oFREvent){
              p3.attr('src', oFREvent.target.result).fadeIn();
          };         
      });

       // Prepare instant image preview
      var p4 = $("#imagePreview4");
      $("#fileInput4").change(function(){        

          var file = $(this)[0].files[0];

          img = new Image();
          var imgwidth = 0;
          var imgheight = 0;          

          img.src = _URL.createObjectURL(file);
          img.onload = function() {
             imgwidth = this.width;
             imgheight = this.height;

             $('#x4').val(1);
             $('#y4').val(1);
             $('#w4').val(imgwidth);
             $('#h4').val(imgheight);
          }         
         
          //fadeOut or hide preview
          p4.fadeOut();         
      
          //prepare HTML5 FileReader
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("fileInput4").files[0]);
      
          oFReader.onload = function(oFREvent){
              p4.attr('src', oFREvent.target.result).fadeIn();
          };         
      });

       // Prepare instant image preview
      var p5 = $("#imagePreview5");
      $("#fileInput5").change(function(){        

          var file = $(this)[0].files[0];

          img = new Image();
          var imgwidth = 0;
          var imgheight = 0;          

          img.src = _URL.createObjectURL(file);
          img.onload = function() {
             imgwidth = this.width;
             imgheight = this.height;

             $('#x5').val(1);
             $('#y5').val(1);
             $('#w5').val(imgwidth);
             $('#h5').val(imgheight);
          }         
         
          //fadeOut or hide preview
          p5.fadeOut();         
      
          //prepare HTML5 FileReader
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("fileInput5").files[0]);
      
          oFReader.onload = function(oFREvent){
              p5.attr('src', oFREvent.target.result).fadeIn();
          };         
      });
    
    
      // Implement imgAreaSelect plugin
      $('#imagePreview').imgAreaSelect({
          minWidth: '600',
          minHeight: '400',
          onSelectEnd: updateCoords
      });

      // Implement imgAreaSelect plugin
      $('#imagePreview1').imgAreaSelect({
          minWidth: '600',
          minHeight: '400',
          onSelectEnd: updateCoords1
      });

      // Implement imgAreaSelect plugin
      $('#imagePreview2').imgAreaSelect({
          minWidth: '600',
          minHeight: '400',
          onSelectEnd: updateCoords2
      });

      // Implement imgAreaSelect plugin
      $('#imagePreview3').imgAreaSelect({
          minWidth: '600',
          minHeight: '400',
          onSelectEnd: updateCoords3
      });
       // Implement imgAreaSelect plugin
      $('#imagePreview4').imgAreaSelect({
          minWidth: '600',
          minHeight: '400',
          onSelectEnd: updateCoords4
      });

       // Implement imgAreaSelect plugin
      $('#imagePreview5').imgAreaSelect({
          minWidth: '600',
          minHeight: '400',
          onSelectEnd: updateCoords5
      });
  });



  $("body").on("click",".Delete_Img", function(){

      if (confirm('Are You Confirmed To Delete This Record?')) 
      {
         var type = 'img_Delete'; 
         var id  =  $(this).attr("ids");
         var tbl = $(this).attr('tbl');
         var col_name = $(this).attr('col_name');
         var dest = $(this).attr('dest');
         var dest_thumb = $(this).attr('dest_thumb');
         var dest_thumb1 = $(this).attr('dest_thumb1');
         var url = '<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>'; 

         var result = null;
         var scriptUrl = "<?=base_url("admin/custom_function")?>";
            $.ajax({
              url: scriptUrl,
              type: 'post',
              data:{
                 ids: id, 
                 tbl: tbl, 
                 type: type, 
                 col_name: col_name, 
                 dest: dest, 
                 dest_thumb: dest_thumb, 
                 dest_thumb1: dest_thumb1, 
              },
              dataType: 'html',
              async: false,
              success: function(data) {
                  result = data;

                    if(data == 1)
                    {
                        $("#success").click();
                        //$('#DivId').load(document.URL +  ' #DivId');
                         location.reload();
                    }
                    else if(data == 0)
                    {
                        $("#error").click(); 
                    }
              } 
           });
        }    
    });   
</script>    