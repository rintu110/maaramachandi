 <div class="content-wrapper">
  <section class="content-header">  
	 <div class="header-icon">
	    <i class="fa fa-sticky-note-o"></i>
	 </div>  
    <div class="header-title">
        <h1><?=(isset($User_Type) && $User_Type!='')?$User_Type:''?></h1>  
        <small>Manage Your Content</small>   
        <ol class="breadcrumb">
           <?=(isset($BreadCrumb) && $BreadCrumb!='')?$BreadCrumb:''?>
        </ol>
    </div>
 </section>