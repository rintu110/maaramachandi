    <!-- Section: home -->
    <section id="home">
      <div class="container-fluid p-0">
        
        <!-- Slider Revolution Start -->
        <div class="rev_slider_wrapper">
          <div class="rev_slider" data-version="5.0">
            <ul>

             <?
                if(is_array($bannerlist) && sizeof($bannerlist,1) > 0)
                {
                    $i = 1;
                    foreach($bannerlist as $v)
                    {
            ?>
                         <li data-index="rs-<?=$i?>" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?=base_url('banner_img/')?><?=$v->bnr_img?>" data-rotate="0" data-saveperformance="off" data-title="Slide <?=$i?>" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="<?=base_url('banner_img/')?><?=$v->bnr_img?>" alt="<?=$v->alt_tag?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina="">      

                            <div class="tp-caption tp-resizeme text-uppercase bg-theme-colored-transparent text-white font-raleway pl-30 pr-30" id="rs-1-layer-2" data-x="['center']" data-hoffset="['0']" data-y="['middle']" data-voffset="['-20']" data-fontsize="['48']" data-lineheight="['70']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;" data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap; font-weight:700; border-radius: 30px;"><?=$v->bnr_heading?>
                            </div>                
                        </li>

            <?        
                     $i++;     
                    }
                }
             ?> 
             
            </ul>
          </div><!-- end .rev_slider -->
        </div>
        <!-- end .rev_slider_wrapper -->
        <script>
          $(document).ready(function(e) {
            $(".rev_slider").revolution({
              sliderType:"standard",
              sliderLayout: "auto",
              dottedOverlay: "none",
              delay: 5000,
              navigation: {
                  keyboardNavigation: "off",
                  keyboard_direction: "horizontal",
                  mouseScrollNavigation: "off",
                  onHoverStop: "off",
                  touch: {
                      touchenabled: "on",
                      swipe_threshold: 75,
                      swipe_min_touches: 1,
                      swipe_direction: "horizontal",
                      drag_block_vertical: false
                  },
                arrows: {
                  style:"zeus",
                  enable:true,
                  hide_onmobile:true,
                  hide_under:600,
                  hide_onleave:true,
                  hide_delay:200,
                  hide_delay_mobile:1200,
                  tmp:'<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                  left: {
                    h_align:"left",
                    v_align:"center",
                    h_offset:30,
                    v_offset:0
                  },
                  right: {
                    h_align:"right",
                    v_align:"center",
                    h_offset:30,
                    v_offset:0
                  }
                },
                bullets: {
                  enable:true,
                  hide_onmobile:true,
                  hide_under:600,
                  style:"metis",
                  hide_onleave:true,
                  hide_delay:200,
                  hide_delay_mobile:1200,
                  direction:"horizontal",
                  h_align:"center",
                  v_align:"bottom",
                  h_offset:0,
                  v_offset:30,
                  space:5,
                  tmp:'<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
                }
              },
              responsiveLevels: [1240, 1024, 778],
              visibilityLevels: [1240, 1024, 778],
              gridwidth: [1170, 1024, 778, 480],
              gridheight: [600, 768, 960, 720],
              lazyType: "none",
              parallax: {
                  origo: "slidercenter",
                  speed: 1000,
                  levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                  type: "scroll"
              },
              shadow: 0,
              spinner: "off",
              stopLoop: "on",
              stopAfterLoops: 0,
              stopAtSlide: -1,
              shuffle: "off",
              autoHeight: "off",
              fullScreenAutoWidth: "off",
              fullScreenAlignForce: "off",
              fullScreenOffsetContainer: "",
              fullScreenOffset: "0",
              hideThumbsOnMobile: "off",
              hideSliderAtLimit: 0,
              hideCaptionAtLimit: 0,
              hideAllCaptionAtLilmit: 0,
              debugMode: false,
              fallbacks: {
                  simplifyAll: "off",
                  nextSlideOnWindowFocus: "off",
                  disableFocusListener: false,
              }
            });
          });
        </script>
        <!-- Slider Revolution Ends -->
      </div>
    </section>
    
    <section>
      <div class="container-fluid p-0 p-sm-15">
        <div class="section-content">
          <div class="row equal-height-inner home-boxes">
            <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay2">
              <div class="sm-height-auto bg-theme-colored-darker2">
                <div class="p-30">
                  <h3 class="text-uppercase text-white mt-0">Trustee</h3>
                  <a href="<?=base_url('trustee-members')?>" class="btn btn-border btn-circled btn-transparent btn-xs mt-5">Click Here</a>
                </div>
                <i class="flaticon-charity-home-insurance bg-icon"></i>
              </div>
            </div>
            <div class="col-sm-12 col-md-3 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay1">
              <div class="sm-height-auto bg-theme-colored">
                <div class="p-30">
                  <h3 class="text-uppercase text-white mt-0">Committee Members</h3>
                  <a href="<?=base_url('committee-members')?>" class="btn btn-border btn-circled btn-transparent btn-xs mt-5">Click Here</a>
                </div>
                <i class="flaticon-charity-shaking-hands-inside-a-heart bg-icon"></i>
              </div>
            </div>
            
            <div class="col-sm-12 col-md-3 pl-0 pr-0 pl-sm-15 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay3">
              <div class="sm-height-auto bg-theme-colored-darker3">
                <div class="p-30">
                  <h3 class="text-uppercase text-white mt-0">Live Membership</h3>
                  <a href="<?=base_url('live-members')?>" class="btn btn-border btn-circled btn-transparent btn-xs mt-5">Click Here</a>
                </div>
                <i class="flaticon-charity-make-an-online-donation bg-icon"></i>
              </div>
            </div>
            <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay4">
              <div class="sm-height-auto bg-theme-colored-darker4">
                <div class="p-30">
                  <h3 class="text-white mt-0 mb-5">Call +91 76849 82330</h3>
                  <a href="tel:7684982330" class="btn btn-border btn-circled btn-transparent btn-xs mt-5">Contact Now</a>
                </div>
                <i class="fa fa-mobile bg-icon"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    