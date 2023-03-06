 <script src='https://www.google.com/recaptcha/api.js' async defer></script>


 <!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?=base_url('frontassets/')?>images/breadcrumb/breadcrumb-1.jpg);">
    
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                        <ul class="clearfix">
                            <li><a href="<?=base_url()?>">Home</a></li>
                            <li class="active">Enquiry Now!</li>
                        </ul>    
                    </div>
                    
                    <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                       <h2>Enquiry Now!</h2>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->


<!--Start Contact Form Style1 Area-->
<section class="contact-form-style1-area contact-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="contact-form contact-page">
                    <form id="contact-forms" name="contact_form" class="default-form2" method="post">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="input-box"> 
                                    <input type="text" name="name" placeholder="Your name" required="">
                                </div>
                                <div class="input-box"> 
                                    <input type="text" name="phonenumber" placeholder="Phone number">
                                </div>     
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="input-box"> 
                                    <input type="email" name="email" placeholder="Email address" required="">
                                </div>
                                <div class="input-box"> 
                                    <input type="text" name="subject" placeholder="Subject">
                                </div>      
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12"> 
                                <div class="input-box">    
                                    <textarea name="message" placeholder="Write message" required=""></textarea>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-xl-12"> 
                                <div class="input-box">    
                                    <div class="g-recaptcha" data-sitekey="<?=$Site_Key?>"></div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="button-box">
                                    <button class="btn-one" type="submit" data-loading-text="Please wait...">
                                        <span class="txt">Send Massage<i class="fa fa-angle-double-right round" aria-hidden="true"></i></span>
                                    </button>    
                                </div>
                            </div>
                        </div> 
                         
                    </form>
                </div>
                    
            </div>
            <div class="col-xl-2"></div>            
        </div>
    </div>
</section>
<!--End Contact Form Style1 Area-->