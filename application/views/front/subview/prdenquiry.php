<script src='https://www.google.com/recaptcha/api.js' async defer></script>

<!--Page Title-->
    <section class="page-title" style="background-image:url(<?=base_url('frontassets/')?>images/background/22.jpg)">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="pull-left">
                    <h1>Online Inquiry</h1>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li>Online Inquiry</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Counter Section -->
    <section class="counter-section" style="background-image:url(<?=base_url('frontassets/')?>images/background/1.jpg); padding-bottom: 124px;">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title light centered">
                <div class="title">NUMBERS SPEAK</div>
                <h2>Product Online Inquiry</h2>
                <div class="seperater style-two"></div>
                <div class="text">We have a long and proud history givin emphasis to environment social and economic <br> outcomes to deliver places that respond.</div>
            </div>


        </div>
    </section>
    <!-- End Counter Section -->

    <!-- Quote Section -->
    <section class="quote-section">
        <div class="auto-container">
            <div class="inner-container">
                <!-- Pattern Layer -->
                <div class="patern-layer" style="background-image: url(<?=base_url('frontassets/')?>images/background/2.jpg)"></div>
                <div class="row clearfix">

                    <!-- Image Column -->
                    <div class="image-column col-lg-5 col-md-12 col-sm-12">
                        <div class="inner-column wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image">
                                <img src="<?=base_url('frontassets/')?>images/resource/quote.jpg" alt="" />
                            </div>
                        </div>
                    </div>

                    <!-- Form Column -->
                    <div class="form-column col-lg-7 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <!-- Sec Title -->
                            <div class="sec-title">
                                <div class="title"> Ningbo Hirelay Technology</div>
                                <h2>Enter Your Request Quote</h2>
                                <div class="seperater style-two"></div>
                            </div>

                            <!-- Default Form -->
                            <div class="default-form">
                                <form method="post">
                                    <div class="row clearfix">

                                        <?
                                            if(isset($info->post_name) && $info->post_name !='')
                                            {
                                        ?>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">  
                                            <input type="text" name="product_nm" placeholder="Product Name - HRT23" value="<?=$info->post_name?>" required="">
                                            <span class="icon fa fa-user"></span>
                                        </div>
                                        <?
                                          }
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <input type="text" name="name" placeholder="Full Name" required="">
                                            <span class="icon fa fa-user"></span>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="email" name="email" placeholder="Email" required="">
                                            <span class="icon fa fa-envelope"></span>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="tel" name="phonenumber" placeholder="Phone No" required="">
                                            <span class="icon fa fa-phone"></span>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <input type="text" name="subject" placeholder="Subject" required="">
                                            <span class="icon fa fa-user"></span>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <textarea name="message" placeholder="Message"></textarea>
                                        </div>

                                         <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                             <div class="g-recaptcha" data-sitekey="<?=$Site_Key?>"></div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <button class="theme-btn btn-style-four" type="submit" name="btn_enquiry"><span class="txt">Submit Now</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Quote Section -->