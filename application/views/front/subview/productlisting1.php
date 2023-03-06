<div class="tt-breadcrumb" style="background-image: url('<?=base_url('frontassets/')?>images/breadcrumb_bg.jpg')">

  <div class="container container-lg-fluid">

    <ul>

      <li><a href="<?=base_url()?>">Home</a></li>

      <li> Products</li>

    </ul>

  </div>

</div>



<main id="tt-pageContent">

  <div class="section-indent">

    <div class="container container-lg-fluid">

      <div class="row">

        <?

          if(sizeof($category_list) > 0)

          {

        ?>

        <div class="col-md-4 col-lg-3 col-xl-3 leftColumn tt-aside" id="aside-js">

          <div class="tt-block-aside tt-block-aside__shadow">

            <h3 class="tt-aside-title">Categories</h3>

            <div class="tt-aside-content">

              <nav class="nav-categories">

                <ul>

                    <?php

                      foreach ($category_list as $k => $v) 

                      {

                    ?>

                      <li>

                         <a href="<?=base_url('product/'.$v->slug_url)?>"><?=$v->cat_name?></a>

                       </li>

                    <?php

                      }

                    ?>  

                </ul>

              </nav>

            </div>

          </div>          

          

          <div class="tt-block-aside tt-block-aside__shadow" style="display: none;">

            <h3 class="tt-aside-title">Popular</h3>

            <div class="tt-aside-content">

              <div class="tt-popular">

                <div class="tt-item">

                  <div class="tt-item__img"><img src="<?=base_url('frontassets/')?>images/product/product-01.jpg" alt=""></div>

                  <div class="tt-item__layout">

                    <div class="tt-title">

                      <a href="#">Woods WiOn 15 amps Receptacle and USB Charger</a>

                    </div>

                    

                  </div>

                </div>

                <div class="tt-item">

                  <div class="tt-item__img"><img src="<?=base_url('frontassets/')?>images/product/product-02.jpg" alt=""></div>

                  <div class="tt-item__layout">

                    <div class="tt-title">

                      <a href="#">Powerboss 3500 watts Gasoline Portable Generator</a>

                    </div>

                    

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <?

          }

        ?>

        <div class="col-md-12 col-lg-9 col-xl-9">

          <div class="section-title text-left">

            <div class="section-title__01">Best Quality Parts</div>

            <div class="section-title__02"><?=($subcategory->cat_name !='')?$subcategory->cat_name:$category->cat_name?></div>

            <div class="section-title__03">

              <p><?=($subcategory->full_dsc !='')?$subcategory->full_dsc:$category->sml_dsc?></p>

            </div>

          </div>

        <!--   <div class="tt-filters-options">

            <div class="row justify-content-between">

              <div class="col-auto ml-right">

                <div class="tt-filters-toggle icon-icon-filter" id="js-filters-toggle"></div>

                <div class="tt-title">Showing 1–9 of 18 results</div>

                <div class="tt-filters-select">

                  <div class="custom-select">

                    <select>

                      <option>Default Sorting</option>

                      <option>Default Sorting 02</option>

                      <option>Default Sorting 03</option>

                    </select>

                  </div>

                </div>

              </div>

              <div class="col-auto">

                <div class="tt-pagination-filter">

                  <div class="tt-pagination-filter__title">Pages:</div>

                  <ul class="tt-pagination-filter__list">

                    <li class="active"><a href="#">1</a></li>

                    <li><a href="#">2</a></li>

                  </ul>

                  <a href="#" class="tt-pagination-filter__btn"><i class="icon-arrow_right"></i></a>

                </div>

              </div>

            </div>

          </div> -->

          <div id="tt-product-listing" class="tt-product-listing row">



            <?php

                  // print_result($prdlist);exit;

                   if(is_array($prdlist) && countz($prdlist) > 0)

                   {

                      foreach ($prdlist as $v) 

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

                    <div class="col-6 col-md-4 tt-col-item">

                      <div class="tt-product tt-layout033">

                        <div class="tt-product__img">

                          <a href="<?=base_url('product/').$category->slug_url.$urls.'/'.$v->slug_url?>">

                            <img src="<?=$img?>" alt="<?=$v->post_name?>">

                          </a>

                        </div>



                        <div class="tt-product__description">

                          <h2 class="tt-product__title">

                            <a href="<?=base_url('product/').$category->slug_url.$urls.'/'.$v->slug_url?>">

                              <?=$v->post_name?>                                

                            </a>

                          </h2>

                        </div>

                      </div>

                    </div>

                <?php    

                        }

                   }

                ?> 

          </div>

         <!--  <div class="tt-pagination">

            <ul>

              <li class="active"><a href="#">1</a></li>

              <li><a href="#">2</a></li>

              <li><a href="#">3</a></li>

              <li><a href="#">...</a></li>

              <li><a href="#">8</a></li>

            </ul>

          </div> -->

        </div>

      </div>

    </div>

  </div>

</main>

