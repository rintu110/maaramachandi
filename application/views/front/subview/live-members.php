 <!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
     <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg" style="background-image: url('<?=base_url('frontassets/')?>images/bg_banner_2.jpg');">
      <div class="container pt-50 pb-30">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-12">
              <h2 class="text-center text-white font-30 mt-20">Live Members</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

     <section id="schedule" class="divider parallax layer-overlay overlay-white-8" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg">
      <div class="container pt-20 pb-10">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-schedule">
                <thead>
                  <tr class="bg-theme-colored">
                    <th>#</th>
                    <th>Booking Date</th>
                    <th>Purpose</th>
                    <th>Name/Gotra</th>
                    <th>Address</th>
                    <th>Donation Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      if(is_array($liveMembers) && sizeof($liveMembers,1) > 0)
                      {
                          $i = 1;
                          foreach($liveMembers as $v)
                          {
                  ?>
                           <tr>
                              <td><?=$i?></td>
                              <td><?=date('d M, Y',strtotime($v->dates))?></td>
                              <td><?=$v->purpose?></td>
                              <td><?=$v->name?> </td>
                              <td><?=$v->address?></td>
                              <td>Rs. <?=number_format($v->yrly_donation,2,'.','')?>/-</td>
                           </tr>

                           <!-- / <?=$v->gotra?> -->

                  <?      
                           $i++;        
                          }
                      }
                  ?>                 
                 
                </tbody>
              </table>
            </div>
          </div>
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