<?php
	$this->load->view('sadmin/inc/metaheader');
    $this->load->view('sadmin/inc/topheader');
    $this->load->view('sadmin/inc/left-sidebar');
    $this->load->view('sadmin/inc/breadcrumb');

	$this->load->view($sub_view);

	if($this->uri->segment(2) == 'pages'  || $this->uri->segment(2) == 'banner'  || $this->uri->segment(2) == 'testimonial'  || $this->uri->segment(2) == 'product'  || $this->uri->segment(2) == 'category' || $this->uri->segment(2) == 'faq') 
	{
		$this->load->view('sadmin/inc/list_footer');
	}
	else
	{
		$this->load->view('sadmin/inc/footer');
	}

?>

