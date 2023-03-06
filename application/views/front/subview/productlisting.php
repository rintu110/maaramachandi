<main id="main">
  <!-- inner Banner-sec-->
  <section class="inner-banner-sec">
    <div class="container">
     <div class="row">
      <h2>Product Listings</h2>
     </div>
   </div>
  </section>

   <section class="section">
    <div class="container">
      <?
       if($category->full_dsc !='')
       {
    ?>
        <div class="row">
          <div class="col-md-12">
            <?=$category->full_dsc?>
          </div>
        </div>
     <?php
       } 
     ?>   
      <div class="row">       
        <div id="aside" class="col-xl-3 col-lg-3 col-md-4 prd-aside">
          <?

              if(is_array($category_list) && sizeof($category_list) > 0)
              {
          ?>
                <div class="aside category-aside">
                  <h3 class="aside-title">Categories</h3>
                    <ul class="pwwcheck-box-list">
                    <?      
                     foreach ($category_list as $k => $v) 
                     {
                        $url = '<a href="'.base_url('product/').$v->slug_url.'">'.$v->cat_name.'</a>';
                        if($this->uri->segment(2) == $v->slug_url)
                        {
                            $url = $v->cat_name;
                        }
                    ?>
                        <li>
                          <label class="checkbox-inline">
                              <?=$url?>
                          </label>
                        </li>
                    <?php       
                     }
                    ?>
                   </ul>
                 </div>   
            <?                         
              }
               if(is_array($featured_prd) && sizeof($featured_prd) > 0)
               {
             ?>
                   <div class="second-aside">
                     <h3 class="aside-title">Featured Products</h3>                    
                    <?
                      foreach ($featured_prd as $k => $v) 
                      {
                          $img = base_url('post/').$v->post_img; 

                           $urls = '';
         
                           if(isset($v->subcategory) && $v->subcategory !='')
                           {
                               $urls = '/'.$v->subcategory;
                           }
                           else if(isset($subcategory->slug_url) && $subcategory->slug_url !='')
                           {
                              $urls = '/'.$subcategory->slug_url;
                           }  
                    ?>
                           <div class="aside-product-widget">
                              <div class="aside-product-img">
                               <a href="<?=base_url('product/').$category->slug_url.$urls.'/'.$v->slug_url?>"> 
                                   <img src="<?=$img?>" alt="<?=$v->post_name?>" class="img-fluid"  loading="lazy">
                               </a> 
                              </div>
                              <div class="aside-product-body">
                                <h3 class="aside-product-name">
                                  <a href="<?=base_url('product/').$category->slug_url.$urls.'/'.$v->slug_url?>">
                                    <?=$v->post_name?>                                      
                                  </a>
                                </h3>
                              </div>
                           </div>
                    <?php     
                      }
                    ?>                     
                   </div>     
             <?   
               }
           ?>            
        </div>
        
        <div id="main" class="col-xl-9 col-lg-9 col-md-8">        
          <div id="store">
          <?
            //print_result($prdlist);exit;
            if(is_array($prdlist) && sizeof($prdlist) > 0)
            {
           ?>
              <div class="row">    
                <?
                   foreach ($prdlist as $k => $v) 
                   {
                         $img = base_url('post/').$v->post_img;  

                         $urls = '';
 
                         if(isset($v->subcategory) && $v->subcategory !='')
                         {
                             $urls = '/'.$v->subcategory;
                         }
                         else if(isset($subcategory->slug_url) && $subcategory->slug_url !='')
                         {
                            $urls = '/'.$subcategory->slug_url;
                         }  
                ?>  
                       <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                          <div class="product product-single">
                            <div class="product-thumb"> 
                              <a href="<?=base_url('product/').$category->slug_url.$urls.'/'.$v->slug_url?>">                   
                                 <img src="<?=$img?>" alt="<?=$v->post_name?>">
                              </a>  
                            </div>
                            <div class="product-body">
                              <h2 class="product-name">
                                <a href="<?=base_url('product/').$category->slug_url.$urls.'/'.$v->slug_url?>">
                                  <?=$v->post_name?>
                                 </a>
                              </h2>                              
                            </div>
                          </div>
                       </div>
                <?php   
                   } 

                   if(is_array($Pcat_list) && sizeof($Pcat_list) > 0)
                   {
                      foreach ($Pcat_list as $v1)
                      {
                           if($v1->post_img !='')
                           {
                              $img = base_url('post/').$v1->post_img;     
                           }
                           else
                           {
                               $img = base_url('frontassets/image/no-image.png');
                           }
                           
                 ?> 
                              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                  <div class="product product-single">
                                    <div class="product-thumb"> 
                                      <a href="<?=base_url('product/').$category->slug_url.'/'.$v1->slug_url?>">                   
                                         <img src="<?=$img?>" alt="<?=$v->cat_name?>">
                                      </a>  
                                    </div>
                                    <div class="product-body">
                                      <h2 class="product-name">
                                        <a href="<?=base_url('product/').$category->slug_url.'/'.$v1->slug_url?>">
                                          <?=$v1->cat_name?>
                                         </a>
                                      </h2>                              
                                    </div>
                                  </div>
                             </div>
                 <?php         
                      }
                 ?>
                        
                 <?php      
                   }
                ?>  
              </div>  
           <?   
            }
          ?>
          </div>
          <div class="store-filter clearfix">
            <?php
              echo $this->pagination->create_links();
           ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  </main>