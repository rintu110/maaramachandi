<?php
	$pg_name = $this->uri->segment(2);
	$p_array = array('add_page','edit_page','add_product','edit_product','add_category','edit_category','site_setting','edit_seo','edit_feature','about_us','edit_desc','add_testimonial','edit_testimonial','add_news','edit_news','add_mediaCoverage','edit_mediaCoverage');

	$this->load->view('admin/inc/metaheader');

	if(in_array($pg_name, $p_array))
	{
		$this->load->view('admin/inc/special_js');	
	}

    $this->load->view('admin/inc/topheader');
    $this->load->view('admin/inc/left-sidebar');
   // $this->load->view('admin/inc/breadcrumb');

	$this->load->view($sub_view);

	$ft_array = array('add_partners','edit_partners','add_testimonial','edit_testimonial','add_banner','edit_banner','add_news','edit_news','add_page','edit_page','add_category','edit_category','add_product','edit_product','add_testimonial','edit_testimonial','add_members','edit_members','add_donation','edit_donation','edit_gallery','add_mediaCoverage','edit_mediaCoverage');

	if(in_array($pg_name, $ft_array))
	{
		$this->load->view('admin/inc/custom_footer_script');
	}

	
	$pg_array = array('pages','banner','t_banner','testimonial','t_testimonial','product','category','faq','t_faq','t_pages','t_category','t_product','request_form','members','livemembers','donation','gallerylist');

	if(in_array($pg_name, $pg_array))
	{
		$this->load->view('admin/inc/list_footer');
	}
	else
	{
		$this->load->view('admin/inc/footer');		
	}

?>