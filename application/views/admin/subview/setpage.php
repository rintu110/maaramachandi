<style type="text/css">
 .rownr {overflow-y: hidden; background-color: rgb(105,105,105); color: white; text-align: right; vertical-align:top; z-index: 0}
    .txt {width: 80%; overflow-x: scroll; background: transparent; z-index: 0}
</style>
 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add Page</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/pages')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success" id="submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_page')?>'">
                <i class="hvr-buzz-out fa fa-share-square-o"></i>&nbsp;Cancel</button>
        </div>
    </div>
   </section>
 <!-- Main content -->
  <section class="content">
    <div class="row">                                              
        <!-- Textual inputs -->
        <div class="col-sm-12">          
             <?
                 $scs = $this->session->flashdata('success');
                  if(!empty($scs))
                  {
                     echo '<div class="alert alert-sm alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">×</span>
                                </button>
                             <strong>Success!</strong> '.$scs.'
                          </div>';
                  }

                  $err = $this->session->flashdata('error');
                  if(!empty($err))
                  {
                      echo '<div class="alert alert-sm alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">×</span>
                                </button>
                             <strong>Danger!</strong>'.$err.'
                            </div>';
                  }
            ?>
            <div class="panel panel-bd">              
              <div class="row">        
                  <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">                         
                     <div class="tab-content"> 
                       <div class="tab-pane fade in active" id="tab1">                    
                            <div class="panel-body">
                                <p class="highlt"><code class="highlighter-rouge">* Fields Are Mandatory</code></p>                            
                                                            
                                                         
                                <div class="form-group row">
                                     <textarea class="rownr" rows="20" cols="10" value="1" readonly></textarea>
                                    <span>
                                      <textarea name="textdata" class="txt" rows="20" cols="180" class="" nowrap="nowrap" wrap="off"
                                      autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                                      onclick="selectionchanged(this)" onkeyup="keyup(this,event)" oninput="input_changed(this)" onscroll="scroll_changed(this)"><?=$FileData?></textarea><br/><br/>
                                      <label>Current position: </label><input id="sel_in" style="border-style:none" readonly>
                                    </span>
                                    <!-- <label class="col-sm-2 col-form-label">Full Description</label>
                                    <div class="col-sm-10">
                                       <textarea name="full_desc" id="editor1"></textarea>
                                        <script>
                                                var editor = CKEDITOR.replace( 'editor1' );
                                                CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                                        </script>
                                    </div> -->
                                </div>
                            </div>
                       </div>                       
                      </div>   
                   </div>  
                 </div>  
              </div>
            </div>
        </div>
    </div>
  </section>   
 </form>      
<script type="text/javascript"> 

  var cntline;
  
  function keyup(obj, e)
  {
      if(e.keyCode >= 33 && e.keyCode <= 40) // arrows ; home ; end ; page up/down
        selectionchanged(obj, e.keyCode);
  }
  
  function selectionchanged(obj)
  {
      var substr = obj.value.substring(0,obj.selectionStart).split('\n');
      var row = substr.length;
      var col = substr[substr.length-1].length;
      var tmpstr = '(' + row.toString() + ',' + col.toString() + ')';
      // if selection spans over 
      if(obj.selectionStart != obj.selectionEnd)
      {
        substr = obj.value.substring(obj.selectionStart, obj.selectionEnd).split('\n');
        row += substr.length - 1;
        col = substr[substr.length-1].length;
        tmpstr += ' - (' + row.toString() + ',' + col.toString() + ')';
      }
      obj.parentElement.getElementsByTagName('input')[0].value = tmpstr;
  }
  
  function input_changed(obj_txt)
  {
      obj_rownr = obj_txt.parentElement.parentElement.getElementsByTagName('textarea')[0];
      cntline = count_lines(obj_txt.value);
      if(cntline == 0) cntline = 1;
      tmp_arr = obj_rownr.value.split('\n');
      cntline_old = parseInt(tmp_arr[tmp_arr.length - 1], 10);
      // if there was a change in line count
      if(cntline != cntline_old)
      {
          obj_rownr.cols = cntline.toString().length; // new width of txt_rownr
          populate_rownr(obj_rownr, cntline);
          scroll_changed(obj_txt);
      }
      selectionchanged(obj_txt);
  }
  
  function scroll_changed(obj_txt)
  {
      obj_rownr = obj_txt.parentElement.parentElement.getElementsByTagName('textarea')[0];
      scrollsync(obj_txt,obj_rownr);
  }
  
  function scrollsync(obj1, obj2)
  {
      // scroll text in object id1 the same as object id2
      obj2.scrollTop = obj1.scrollTop;
  }
  
  function populate_rownr(obj, cntline)
  {
      tmpstr = '';
      for(i = 1; i <= cntline; i++)
      {
        tmpstr = tmpstr + i.toString() + '\n';
      }
      obj.value = tmpstr;
  }
  
  function count_lines(txt)
  {
      if(txt == '')
      {
        return 1;
      }
      return txt.split('\n').length + 1;
  }
  
</script>