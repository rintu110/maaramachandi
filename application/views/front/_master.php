<?php	
    $this->load->view('front/inc/metaheader');
 ?>
 	<body class="">
	 <div id="wrapper">
 <?     
    $this->load->view('front/inc/loader');
    $this->load->view('front/inc/navbar');
	$this->load->view($subview);
	$this->load->view('front/inc/footer');
?>	
    </div>
<?php	
    $this->load->view('front/inc/footer_js');
 ?>

</body>
</html>