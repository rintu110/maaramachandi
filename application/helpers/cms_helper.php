<?php 
    
   /* function array_search($ary,$val)
    {
        foreach ($ary as $v) 
        {
            if(isset($v))
            {
                
            }
        }
    }*/

    function remove_key($main_arry,$arry_search = NULL)
    {
         if(is_array($main_arry) && sizeof($main_arry,1) > 0)
         {
             // print_result($arry_search);
              foreach($main_arry as $k=>$v)  
              {
                  if($arry_search != '')
                  {
                      if(is_array($arry_search) && sizeof($arry_search,1) > 1)
                      {
                          foreach($arry_search as $v1)
                          {
                                 echo $v;
                                 if(strpos($v1, $v) !== FALSE)
                                 {
                                         echo $k;
                                 }
                          }
                      }
                  }
                 
                  // print_result($v); 
              }
         }
    }


    function createThumbnail($filename, $thumb_width, $thumb_height, $upload_dir, $upload_dir_thumbs)    
    {     
        $upload_image = $upload_dir.$filename;
        $thumbnail_image = $upload_dir_thumbs.$filename;
        list($width,$height) = getimagesize($upload_image);
        $thumb = imagecreatetruecolor($thumb_width,$thumb_height);  
        if(preg_match('/[.](jpg|jpeg)$/i', $filename)) {
            $image_source = imagecreatefromjpeg($upload_image);
        } else if (preg_match('/[.](gif)$/i', $filename)) {
            $image_source = imagecreatefromgif($upload_image);
        } else if (preg_match('/[.](png)$/i', $filename)) {
            $image_source = imagecreatefrompng($upload_image);
        } else {
            $image_source = imagecreatefromjpeg($upload_image);
        }   
        imagecopyresized($thumb,$image_source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);   
        if(preg_match('/[.](jpg|jpeg)$/i', $filename)) {
            imagejpeg($thumb,$thumbnail_image,100);        
        } else if (preg_match('/[.](gif)$/i', $filename)) {
            imagegif($thumb,$thumbnail_image,100);
        } else if (preg_match('/[.](png)$/i', $filename)) {
            imagepng($thumb,$thumbnail_image,100);
        } else {
            imagejpeg($thumb,$thumbnail_image,100);
        }   
    }
    
    function array_search_multidim($m_array, $key, $val)
    {
        $out = array();
        $i = 0;
        $m_array = (object) $m_array;

        foreach($m_array as $a)
        {            
            if(isset($a->$key))
            {
                if($a->$key==$val){
                    $out[$i]=$a;
                    $i++;
                }
            }else{
                if($a[$key]==$val)
                {
                    $out[$i]=$a;
                    $i++;
                }
            }
        }
        return $out;
    }

    function  cat_nm($cat_url)
    {
         $ci = & get_instance();
         $ci->load->database();

         $q = $ci->db->query("SELECT cat_name FROM category where slug_url = '".$cat_url."' AND status = 1 AND del_status = 0")->row();

         echo $q->cat_name;
    }

    function countproduct($cat_id)
    {
       $ci = & get_instance();
       $ci->load->database();

       $q = $ci->db->query("SELECT COUNT(id) as `Total_Product` FROM post WHERE cat_id = $cat_id")->row();

       return $q->Total_Product;


    }

    function CATLIST($page = Null)
    {        
       $ci = & get_instance();
       $ci->load->database();

       $URL = $ci->uri->segment(2);

       $q = $ci->db->query("SELECT cat_name,slug_url,id FROM category where status = 1 AND del_status = 0 AND post_type = 'Product'  and parent_id != 0 AND cat_name !='Product' ORDER BY sequence ASC")->result();

       //print_result($q);exit;

       if(is_array($q) && countz($q) > 0)
       {
           $str = '';
           $str .= '<ul>';

           foreach ($q as $v) 
           {
               $active = '';

               $num = '';

               if($page!= '')
               {
                   if($URL == $v->slug_url) 
                   {
                       $active = 'class="active"';  
                   }

                   $num = countproduct($v->id);

                   if($num < 10)
                   {
                      $num = '0'.$num;
                   }
                   else
                   {
                      $num = $num;
                   }

                   $num = ' <span>'.$num.'</span>';
               }     

               $url = base_url('product/').$v->slug_url;
               $str .= '<li '.$active.'><a href="'.$url.'">'.$v->cat_name.$num.'</a></li>';
           } 
           $str .= '</ul>';

           echo $str;
       }


    }

     function NEWSCATLIST($page = Null)
    {        
       $ci = & get_instance();
       $ci->load->database();

       $URL = $ci->uri->segment(2);

       $q = $ci->db->query("SELECT cat_name,slug_url,id FROM category where status = 1 AND del_status = 0 AND post_type = 'News'  and parent_id = 0  ORDER BY sequence ASC")->result();

       //print_result($q);exit;

       if(is_array($q) && countz($q) > 0)
       {
           $str = '';  

           foreach ($q as $v) 
           {
               $num = countproduct($v->id);

               if($num < 10)
               {
                  $num = '0'.$num;
               }
               else
               {
                  $num = $num;
               }

               $num = ' <span>'.$num.'</span>';

               $url = base_url('news/').$v->slug_url;
               $str .= '<li><a href="'.$url.'">'.$v->cat_name.$num.'</a></li>';
           }           

           echo $str;
       }


    }

    function update_menu_url_nm($post_type,$id,$name,$url)
    {    
       $ci = & get_instance();
       $ci->load->database();

       $upd = $ci->db->query("UPDATE menu set menu_name = '".$name."', menu_url = '".$url."' where col_value = $id AND table_nm = '".strtolower($post_type)."'");

    }

    function menu_bk()
    {   
        $ci = & get_instance();
        $ci->load->database();

        $q = $ci->db->query("SELECT menu_url,menu_name,col_value,parent_menu_id,post_type,parent_submenu_id FROM menu where del_status = 0 and master_menu_id = '1'  AND parent_menu_id = 0 ORDER BY sequence ASC")->result();   

       // print_result($q);exit;   

        if(is_array($q) && sizeof($q)>0)
        {
            $str = '';
           
            foreach ($q as $v) 
            {
                $data = '';
                $submenu = ''; 
                $active_class ='';

                if($v->post_type == 'Page')
                {
                    $data = " AND post_type = 'Page'";
                }
                else if($v->post_type == 'Category')
                {
                    $data = " AND ( post_type = 'Category' OR   post_type = 'Post' )";
                }

                $Menu_URL = Menu_URL($v->col_value,$v->post_type);

                $qq = $ci->db->query("SELECT col_value,post_type,menu_name,parent_menu_id,menu_url FROM menu where del_status = 0 and master_menu_id = '1' AND  parent_menu_id = '".$v->col_value."' AND parent_menu_id != 0 AND  parent_submenu_id = 0 $data ORDER BY sequence ASC")->result();

                if(is_array($qq) && sizeof($qq)>0)
                {                   
                    $active_class ='class="drop-down"';
                    $submenu .= '<ul>';

                    foreach ($qq as $v1) 
                    {
                        $innermenu = '';                        
                        $innermenus = ''; 
                        $active_class_inr = '';
                      
                        $qqq =  $ci->db->query("SELECT col_value,post_type,menu_name,parent_menu_id,menu_url FROM menu where del_status = 0 and master_menu_id = '1' AND  parent_menu_id = '".$v1->parent_menu_id."' AND parent_submenu_id = '".$v1->col_value."' $data ORDER BY sequence ASC")->result();

                        $prd_inr = $ci->db->query("SELECT id,post_name,cat_id,slug_url,subcat_id FROM post where 1 AND cat_id = '".$v1->col_value."' AND subcat_id = 0 AND status = 1 AND del_status = 0")->result();

                        //print_result($qqq);
                         //Menu List from post
                        

                         if(countz($qqq) > 0  && is_array($qqq))   
                         {
                              //$innermenus .= '<ul>';
                              $active_class_inr ='class="drop-down"';

                              //Menu List from Menu
                              foreach ($qqq as $v2) 
                              {
                                   $InnerMenu_URL =  base_url().$Menu_URL.'/'.$v1->menu_url.'/'.Menu_URL($v2->col_value,$v2->post_type);
                                   $innermenus .= '<li><a href="'.$InnerMenu_URL.'">'.$v2->menu_name.'</a></li>';
                              }

                              //$innermenu .= $innermenus;

                              //$innermenus .= '</ul>';
                         }   

                         if(countz($prd_inr) > 0 && is_array($prd_inr))
                         {
                             $innermenu .= '<ul>';
                             $active_class_inr ='class="drop-down"';
                             foreach ($prd_inr as  $v3) 
                             {
                                  $InnerMenu_URL =  base_url().$Menu_URL.'/'.$v1->menu_url.'/'.Menu_URL($v3->id,'Post');
                                  $innermenu .= '<li><a href="'.$InnerMenu_URL.'">'.$v3->post_name.'</a></li>';
                             }

                             $innermenu .= $innermenus;
                             $innermenu .= '</ul>';
                        }                     

                        $SubMenu_URL = base_url().Menu_URL($v1->col_value,$v1->post_type); 

                        if($v1->post_type == 'Category')
                        {
                            $SubMenu_URL = base_url().$Menu_URL.'/'.Menu_URL($v1->col_value,$v1->post_type);   
                        }
                        
                        $submenu .= '<li '.$active_class_inr.'><a href="'.$SubMenu_URL.'">'.$v1->menu_name.'</a>'.$innermenu.'</li>';
                    }

                    $submenu .= '</ul>';
                }

                if($v->parent_menu_id == 0 && $v->parent_submenu_id == 0)
                {
                    $str .= '<li '.$active_class.'><a href="'.base_url().$Menu_URL.'">'.$v->menu_name.'</a>'.$submenu.'</li>';
                }   
            }   

            echo $str;
        }
    }

    function MENU()
    {   
        $ci = & get_instance();
        $ci->load->database();

        $q = $ci->db->query("SELECT menu_url,menu_name,col_value,parent_menu_id,post_type,parent_submenu_id FROM menu where del_status = 0 and master_menu_id = '1'  AND parent_menu_id = 0 ORDER BY sequence ASC")->result();   

       // print_result($q);exit;   

        if(is_array($q) && sizeof($q)>0)
        {
            $str = '';
           
            foreach ($q as $v) 
            {
                $data = '';
                $submenu = ''; 
                $active_class ='';

                if($v->post_type == 'Page')
                {
                    $data = " AND post_type = 'Page'";
                }
                else if($v->post_type == 'Category')
                {
                    $data = " AND ( post_type = 'Category' OR   post_type = 'Post' )";
                }

                $Menu_URL = Menu_URL($v->col_value,$v->post_type);

                $qq = $ci->db->query("SELECT col_value,post_type,menu_name,parent_menu_id,menu_url FROM menu where del_status = 0 and master_menu_id = '1' AND  parent_menu_id = '".$v->col_value."' AND parent_menu_id != 0 $data ORDER BY sequence ASC")->result();

                if(is_array($qq) && sizeof($qq)>0)
                {                   
                    $active_class ='class="drop-down"';
                    $submenu .= '<ul>';

                    foreach ($qq as $v1) 
                    {
                        $innermenu = '';                        
                        $innermenus = ''; 
                        $active_class_inr = '';
                      
                        $qqq =  $ci->db->query("SELECT col_value,post_type,menu_name,parent_menu_id,menu_url FROM menu where del_status = 0 and master_menu_id = '1' AND  parent_menu_id = '".$v1->parent_menu_id."' AND parent_submenu_id = '".$v1->col_value."' $data ORDER BY sequence ASC")->result();

                        $prd_inr = $ci->db->query("SELECT id,post_name,cat_id,slug_url,subcat_id FROM post where 1 AND cat_id = '".$v1->col_value."' AND subcat_id = 0 AND status = 1 AND del_status = 0")->result();

                        //print_result($qqq);
                         //Menu List from post
                        

                         if(countz($qqq) > 0  && is_array($qqq))   
                         {
                              //$innermenus .= '<ul>';
                              $active_class_inr ='class="drop-down"';

                              //Menu List from Menu
                              foreach ($qqq as $v2) 
                              {
                                   $InnerMenu_URL =  base_url().$Menu_URL.'/'.$v1->menu_url.'/'.Menu_URL($v2->col_value,$v2->post_type);
                                   $innermenus .= '<li><a href="'.$InnerMenu_URL.'">'.$v2->menu_name.'</a></li>';
                              }

                              //$innermenu .= $innermenus;

                              //$innermenus .= '</ul>';
                         }   

                         if(countz($prd_inr) > 0 && is_array($prd_inr))
                         {
                             $innermenu .= '<ul>';
                             $active_class_inr ='class="drop-down"';
                             foreach ($prd_inr as  $v3) 
                             {
                                  $InnerMenu_URL =  base_url().$Menu_URL.'/'.$v1->menu_url.'/'.Menu_URL($v3->id,'Post');
                                  $innermenu .= '<li><a href="'.$InnerMenu_URL.'">'.$v3->post_name.'</a></li>';
                             }

                             $innermenu .= $innermenus;
                             $innermenu .= '</ul>';
                        }                     

                        $SubMenu_URL = base_url().Menu_URL($v1->col_value,$v1->post_type); 

                        if($v1->post_type == 'Category')
                        {
                            $SubMenu_URL = base_url().$Menu_URL.'/'.Menu_URL($v1->col_value,$v1->post_type);   
                        }
                        
                        $submenu .= '<li '.$active_class_inr.'><a href="'.$SubMenu_URL.'">'.$v1->menu_name.'</a>'.$innermenu.'</li>';
                    }

                    $submenu .= '</ul>';
                }

                if($v->parent_menu_id == 0 && $v->parent_submenu_id == 0)
                {
                    $str .= '<li '.$active_class.'><a href="'.base_url().$Menu_URL.'">'.$v->menu_name.'</a>'.$submenu.'</li>';
                }   
            }   

            echo $str;
        }
    }

     function Menu_URL($id,$post_type)
     {     
           $page_url = 'slug_url';     

           if($post_type == 'Page')
           {
               $table = 'page';
           }
           else if($post_type == 'Category')
           {
               $table = 'category';           
           }           
           else if($post_type == 'Post')
           {
                $table = 'post';
           }          
           $ci = & get_instance();
           $ci->load->database();   

           //echo "SELECT $page_url FROM $table WHERE id = '$id'";exit;

           $q = $ci->db->query("SELECT $page_url FROM $table WHERE id = '$id'")->row();          
           
           if(countz($q)>0)
           {    
                return $q->$page_url;
           }                     
     }  

    function subcategorys($cat_id,$cat_url)
    {
        $ci = & get_instance();
        $ci->load->database();

        $q = $ci->db->query("SELECT slug_url,cat_name FROM category WHERE 1 AND status = 1 AND del_status = 0 AND post_type = 'Product' and parent_id = '".$cat_id."'")->result();

        //print_result($q);exit;

        if(sizeof($q) > 0)
        {
            $str = '';

            $str .= '<ul style="margin-left:5px">';
            foreach ($q as $v) 
            {
                $str .= '<li><a href="'.base_url('product/').$cat_url.'/'.$v->slug_url.'">'.ucwords($v->cat_name).'</a></li>';
            }

            $str .= '</ul>';
        }

        echo $str;
    }

    function update_status()
    {   
        $ci = & get_instance();
        $ci->load->database();

        if(isset($_POST['ids']))            
            $id = $_POST['ids'];

        if(isset($_POST['val']))            
            $status = $_POST['val'];

        if(isset($_POST['tbl']))   
            $table = $_POST['tbl'];

        if(isset($_POST['type']))   
            $type = $_POST['type'];

        if(isset($_POST['col_name']))   
            $col_name = $_POST['col_name'];

        if(isset($_POST['dest']))   
            $dest = $_POST['dest'];

        if(isset($_POST['dest_thumb']))   
            $dest_thumb = $_POST['dest_thumb'];

         if(isset($_POST['dest_thumb1']))   
            $dest_thumb1 = $_POST['dest_thumb1'];

       // print_result($_POST);exit;

        if($type == 'Status')
        {
            $q = $ci->db->query("UPDATE $table SET status = '".$status."' where id = $id");

            $data = 0;

            if($ci->db->affected_rows() == 1)
                $data = 1;
        }

        if($type == 'img_Delete')
        {
            $d = $ci->db->query("SELECT $col_name FROM $table where id = $id")->row();

           // print_result($d);exit;

            if(countz($d) > 0)
            {
                $img_path = $dest.'/'.$d->$col_name;

                if(file_exists($img_path))
                {
                    unlink($img_path);
                }

                $thumb_path = $dest_thumb.'/'.$d->$col_name;

                if(file_exists($thumb_path))
                {
                    unlink($thumb_path);
                }

                $thumb_path1 = $dest_thumb1.'/'.$d->$col_name;

                if(file_exists($thumb_path1))
                {
                    unlink($thumb_path1);
                }

                $q = $ci->db->query("UPDATE $table SET $col_name = '' where id = $id");

                $data = 0;

                if($ci->db->affected_rows() == 1)
                    $data = 1;
                }
           
        }       

        echo $data; 
    } 

    function upload_img($src,$fileName,$org_img,$thumb_img)
    {
       // $fileName   = basename($src["name"]); 
        $fileTmp    = $src["tmp_name"];
        $fileType   = $src["type"];
        $fileSize   = $src["size"];
        $fileExt    = substr($fileName, strrpos($fileName, ".") + 1);   
        
        // Specify the images upload path
        $largeImageLoc = $org_img.$fileName;
        $thumbImageLoc = $thumb_img.$fileName; 

        // Check and validate file extension
        if((!empty($src)) && ($src["error"] == 0)){
            if($fileExt != "jpg" && $fileExt != "jpeg" && $fileExt != "png" && $fileExt != "gif" && $fileExt != "webp"){
                $error = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        }else{
            $error = "Select an image file to upload.";
        }
     
        // If everything is ok, try to upload file
        if(empty($error) && !empty($fileName))
        {
            if(move_uploaded_file($fileTmp, $largeImageLoc))
            {
                // File permission
                chmod($largeImageLoc, 0777);
                
                // Get dimensions of the original image
                list($width_org, $height_org) = getimagesize($largeImageLoc);
                
                // Get image coordinates
                $x = (int) $_POST['x'];
                $y = (int) $_POST['y'];
                $width = (int) $_POST['w'];
                $height = (int) $_POST['h'];

                // Define the size of the cropped image
                $width_new = $width;
                $height_new = $height;
                
                // Create new true color image
                $newImage = imagecreatetruecolor($width_new, $height_new);
                
                // Create new image from file
                switch($fileType) {
                    case "image/gif":
                        $source = imagecreatefromgif($largeImageLoc); 
                        break;
                    case "image/pjpeg":
                    case "image/jpeg":
                    case "image/jpg":
                        $source = imagecreatefromjpeg($largeImageLoc); 
                        break;
                    case "image/png":
                    case "image/x-png":
                        $source = imagecreatefrompng($largeImageLoc); 
                        break;
                    case "image/webp": 
                        $source = imagecreatefromwebp($largeImageLoc); 
                        break;   
                }
                
                // Copy and resize part of the image
                imagecopyresampled($newImage, $source, 0, 0, $x, $y, $width_new, $height_new, $width, $height);
                
                // Output image to file
                switch($fileType) {
                    case "image/gif":
                        imagegif($newImage, $thumbImageLoc); 
                        break;
                    case "image/pjpeg":
                    case "image/jpeg":
                    case "image/jpg":
                        imagejpeg($newImage, $thumbImageLoc, 90); 
                        break;
                    case "image/png":
                    case "image/x-png":
                        imagepng($newImage, $thumbImageLoc);  
                        break;
                     case "image/webp":
                        imagepng($newImage, $thumbImageLoc);  
                        break;    
                }
                
                // Destroy image
                imagedestroy($newImage);

                // Display cropped image
               // echo 'CROPPED IMAGE:<br/><img src="'.$thumbImageLoc.'"/>';
            }
        }    
    }


    function make_thumb($src, $dest, $desired_width)
    {
        //echo $src; exit();
        // Make directory if not made
        if(!is_dir($dest))
            mkdir($dest,0755,true);
        // Get path info
        $pInfo  =   pathinfo($src);

        // Save the new path using the current file name         
        $dest   =   $dest."/".$pInfo['basename'];

        // Do the rest of your stuff and things...
        if($pInfo['extension'] == 'jpg')
        {
            $source_image = imagecreatefromjpeg($src);
        }
        else  if($pInfo['extension'] == 'png')
        {
            $source_image = imagecreatefrompng($src);
        }
        else  if($pInfo['extension'] == 'gif')
        {
            $source_image = imagecreatefromgif($src);
        }
        else
        {
            $source_image = $src;
        }

      /*  else  if($pInfo['extension'] == 'webp')
        {
            $source_image = imagecreatefrompng($src);
        }*/

        $width = imagesx($source_image);
        $height = imagesy($source_image);
        $desired_height = floor($height * ($desired_width / $width));
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
        imagejpeg($virtual_image, $dest);
    }


    function get_prd_listing($url)
    {
        if($url !='')
        {
            $ci = & get_instance();
            $ci->load->database();
        
            $q = $ci->db->query("SELECT slug_url,cat_name FROM category 
                                                where 1
                                                AND parent_id  = ( SELECT id FROM category where slug_url = '".$url."' AND post_type = 'Product')
                                                AND parent_id != 0
                                                ORDER by sequence ASC
                                                ")->result();

            //print_result($q);exit;
            //
            $m = '';

            if(is_array($q) && countz($q) > 0)
            {           
                $m .= '<ul>';
                                          
                foreach ($q as $k => $v) 
                {
                    $m.= '<li><a href="'.base_url('product/').$url.'/'.$v->slug_url.'">'.$v->cat_name.'</a></li>';
                }

                $m .= '</ul>';
            }

            echo $m;
        }
    }


    function format_name($name)
    {
        return ucwords($name);
    }

    function countz($val)
    {
        $result = (array)$val;
        return count($result);
    }

    function print_result($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }


    function take_backup($data)
    {
        $ci = & get_instance();
        $ci->load->database();
        $data['added_by'] = $ci->session->userdata('user_id');
        $data['added_on'] = date('Y-m-d H:i:s');
        $qry = $ci->db->insert('master_bkup',$data);
    }

    function CheckArrayByKey($myvalue,$myarray,$keyname,$valuename){
        $m='';
        foreach($myarray as $k){
            if($k[$keyname] ==$myvalue){
                $m=$k[$valuename];
            }
        }
        return $m;

    }

    function char_limiter($x, $length)
    {
          if(strlen($x)<=$length)
          {
            return $x;
          }
          else
          {
            $y=substr($x,0,$length) . '...';
            return $y;
          }
    }
?>