 <!-- Start main-content -->
 
  <div class="main-content">

    <!-- Section: inner-header -->
     <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg" style="background-image: url('<?=base_url('frontassets/')?>images/bg_banner_2.jpg');">
      <div class="container pt-50 pb-30">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-12">
              <h2 class="text-center text-white font-30 mt-20">Donation</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="section-content">
         <form method="post" name="frm_search">
          <div class="row">
            <div class="col-md-12"> 
            <div class="row">             
               <div class="col-sm-2">
                <div class="form-group">                    
                  <select name="year" class="form-control">
                     <?php
                         for($y = 2020; $y <= date('Y'); $y++)
                         {
                            $sel = '';
                            if($y == date('Y'))
                            {
                                $sel = 'SELECTED';
                            }
                     ?>
                          <option value="<?=$y?>" <?=$sel?>><?=$y?></option>
                     <?php
                         } 
                     ?>     
                  </select>  
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group"> 
                <select class="form-control input-md" name="month">
                    <option value="">Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>   
                </div>
              </div>
               <div class="col-sm-4">
                <div class="form-group">
                    <button type="submit" name="Search" class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30">Search</button>&nbsp;&nbsp;
                    <button type="button" name="Clear" class="btn btn-flat btn-dark mt-10 pl-30 pr-30">Clear</button>
                </div>
               </div>   
             </div> 
           </div>
           
           <?php
              if(is_array($all_data) && sizeof($all_data,1) > 0)
              {
                  foreach($all_data as $v)
                  {
                       $q = $this->db->query("SELECT id,year,month,img,description,name FROM donation 
                                                                WHERE 1
                                                                AND year = '".$v->year."'
                                                                AND month = '".$v->month."'
                                                                ")->result();

                       $dateObj   = DateTime::createFromFormat('!m', $v->month);
                       $monthName = $dateObj->format('F');

                      if(is_array($q) && sizeof($q,1) > 0)
                      {
                          echo '<div class="col-md-12">
                                <div class="heading-line-bottom">
                                  <h4 class="heading-title">'.$monthName.' - '.$v->year.'</h4>
                                </div>';
                           echo '<div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery">';     

                          foreach($q as $v1)
                          {  
                               if($v1->img !='')
                               {
                                   $img = base_url('post/donation/').$v1->img;
                               }
                              // $img = $v1->img;

                               echo ' <div class="gallery-item design">
                                      <div class="thumb">
                                        <img class="img-fullwidth" src="'.$img.'" alt="'.$v1->name.'">
                                        <div class="overlay-shade"></div>
                                        <div class="text-holder">
                                          <div class="title text-center">'.$v1->name.'</div>
                                        </div>
                                        <div class="icons-holder">
                                          <div class="icons-holder-inner">
                                            <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                              <a href="'.$img.'" data-lightbox-gallery="gallery" title="'.$v1->name.'">
                                              <i class="fa fa-picture-o"></i>
                                              </a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                          }

                          echo '</div>
                                </div>';
                      }    

                  }
              }
           ?>

              
                       
             
              <!-- <div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery" >
                <div class="gallery-item design" style="position: absolute; left: 0px; top: 0px;">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">Sample Title</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               
                <div class="gallery-item branding photography" style="position: absolute; left: 285px; top: 0px;">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">Sample Title</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="i<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               
                <div class="gallery-item design" style="position: absolute; left: 570px; top: 0px;">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">Sample Title</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="gallery-item branding" style="position: absolute; left: 855px; top: 0px;">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">Sample Title</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="gallery-item design photography" style="position: absolute; left: 0px; top: 159px;">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">Sample Title</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="gallery-item photography" style="position: absolute; left: 285px; top: 159px;">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">Sample Title</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="gallery-item branding" style="position: absolute; left: 570px; top: 159px;">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">Sample Title</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="<?=base_url('frontassets/')?>images/gallery/Misc2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>             
              </div> -->             
            </div>
          </div>
         </form>  
        </div>
      </div>
    </section>

    <section class="bg-theme-colored">
      <div class="container pt-0 pb-0">
          <div class="call-to-action sm-text-center">
          <div class="row">
            <div class="col-md-9">
              <h3 class="mt-5 text-white">Maa Ramachandi Temple Trust</h3>
            </div>
            <div class="col-md-3 text-right flip sm-text-center"> 
              <a href="tel:7684982330" class="btn btn-default btn-circled btn-lg mt-5">Call Now<i class="fa fa-angle-double-right font-16 ml-10"></i></a> 
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>