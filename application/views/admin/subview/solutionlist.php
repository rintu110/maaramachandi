<!-- Main content -->
 <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Solution List&nbsp;&nbsp;                          
                            <button type="button" class="btn btn-sm btn-primary w-md m-b-5" onclick="window.location='<?=base_url('admin/add_solution')?>'">Add Solution </button>&nbsp;&nbsp;   
                            <button type="button" class="btn btn-sm btn-danger w-md m-b-5" onclick="window.location='<?=base_url('admin/t_solution')?>'">Trash</button></h4>
                        </div>
                    </div>
                    <div class="panel-body">                                   
                        <div class="table-responsive">
                            <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SlNo</th>
                                        <th>Title</th>
                                        <th>URL</th>
                                        <th>Image</th>                                                                                
                                        <th>Status</th>
                                        <th>Sequence</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?=$alldata?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>                  
    </section> <!-- /.content -->
  <script type="text/javascript">
    function sequence(val,ids)
    {      
         $.get("<?=base_url('admin/update_sequence')?>/post/"+ids+"/"+val, function(data){

            if(data == 1)
            {
                $("#success").click();
            }
            else if(data == 0)
            {
                $("#error").click(); 
            }
        });        
    }   
</script>
<button id='success'  onclick="javascript: toastr.success('Success - Record has sequenced.'); return false;" style="display:none" >Success</button>
<button id='error' onclick="javascript: toastr.error('Error - Unable to process your request! Please try again.'); return false;" style="display:none">Error</button>         