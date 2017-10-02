<?php
namespace IodogsProduct\View\Helper;

use Zend\View\Helper\AbstractHelper;

class _ProductHelper extends AbstractHelper
{    
     protected $id = null;
     protected $category;
     protected $line;
     protected $eng_title;
     protected $rus_title;     
     protected $preview;
     protected $vantage;
     protected $card_text;  
     protected $application_text;
     protected $ingredients;
     protected $active;
     protected $in_stock;
     protected $images;
     
     public function __construct($product)
     {
          if(is_array($product)){
               $this->id = $product['id'];
               $this->category = $product['category'];
               $this->line = $product['line'];
               $this->eng_title = $product['eng_title'];
               $this->rus_title = $product['rus_title'];
               $this->preview = $product['preview'];
               $this->vantage = $product['vantage'];
               $this->card_text = $product['card_text'];
               $this->application_text = $product['application_text'];
               $this->ingredients = $product['ingredients'];
               $this->active = $product['active'];
               $this->in_stock = $product['in_stock'];
               $this->images = $product['images'];
          }
          else
              throw new \Exception("Нет массива продуктов", 1);
          
     }

     public function __invoke($product)
     {          
          if($this->id)
               return $this;
          else {
          $this->id = $product['id'];
          $this->category = $product['category'];
          $this->line = $product['line'];
          $this->eng_title = $product['eng_title'];
          $this->rus_title = $product['rus_title'];
          $this->preview = $product['preview'];
          $this->vantage = $product['vantage'];
          $this->card_text = $product['card_text'];
          $this->application_text = $product['application_text'];
          $this->ingredients = $product['ingredients'];
          $this->active = $product['active'];
          $this->in_stock = $product['in_stock'];
          $this->images = $product['images'];
          
        }  
     }

     public function preview($product)
     {
          $classString = "thumbnail product product-line line-".$product['line']." product-category category-".$product['category'];
     ?>                          
          <div style="position: relative; margin: 5px; border: 0px dashed; height: 300px;" class="<?=$classString?>">
          <a href="/product<?=$product['id']?>">
          <img class="img-responsive" style="margin:auto;>" src="<?php echo $product['images']['cover']['small_file_path'] ?>" alt="<?=$product['eng_title']?>" class="img-responsive">
          </a>
          <div style="    position: absolute;
    padding: 2px 3px;
    background: rgba(242, 242, 242, 0.6);
    bottom: 0;">
               <a style="color: #000;" href="/product<?=$product['id']?>"><?=$product['rus_title']?></a>
          </div>
           
          </div>
                     
          <?php                                                         
     }          

     public function showAll($products)
     {
          ?>
          <ul class="list-unstyled "><?php
          foreach ($products as $product) {
             ?><li class="col-md-3"><?=$this->preview($product) ?></li><?php

          }
          ?></ul><?php
     }
    
    public function showDetail(){
     if(!$this->id)
          throw new Exception("Не найдено продукта", 1);
     else{
           echo "hello!";
     }
    }

     public function showFullInfo($product)
     {
         // print_r($product);
          if($product)
          {
               ?>
          <div class="container">
               <div style="margin:auto; text-align:center;" class="col-md-5 col-md-offset-0">
               <img 
               src="
               <?php echo $product['images']['cover']['file_path'] ?>
               " alt="">  
               <?php
               //print_r($product['images']['galery']);
               if(count($product['images']['galery'])>1){
                    foreach($product['images']['galery'] AS $image){
                         ?>
                         <img class="img-responsive" src="
                         <?=$image['small_file_path'] ?>
                         " alt="">
                         <?php
                    }
               }
                ?>        
               </div>
               <div class="col-md-6 col-md-offset-1" style="border-radius: 5px; border: 1px solid #dadada;">
               <h2 class="center" style="clear: both;"><?=$product['rus_title']?></h2>
               <ul class="nav nav-tabs">
<li class="active"><a href="#info" data-toggle="tab">Информация</a></li>
<?php if(!empty($product['application_text'])){ ?>
<li><a href="#application" data-toggle="tab">Применение</a></li>
<li><a href="#vantages" data-toggle="tab">Преимущества</a></li>
<?php } ?>
</ul>
<div class="tab-content">
<div id="info" class="tab-pane fade in active">
<p style="display: none;"><?=$product['preview']?></p>
<p><?=$product['card_text']?></p>
</div>
 <div id="vantages" class="tab-pane fade in">
<?=$product['vantage']?>
</div>
<?php if(!empty($product['application_text'])){ ?>
<div id="application" class="tab-pane fade in ">
   <?=$product['application_text']?>  
</div>
<?php } ?>
<?php $this
                    ->view
                    ->PageHelper()
                    ->getSocialLikesPanel(); ?> 
                    <span style="margin: auto; text-align: center;">поделитесь, чтобы не потерять</span>  
</div>
                
                              
              

               </div>
          </div>        
               <?php $this->view->ReviewHelper()->showAll() ?>                                          
               <?php
          }
     }

     public function showCategories($categories)
     {
          if(is_array($categories) && count($categories)>0)
          {
               ?><ul class="list-unstyled list-inline"><?php
               foreach ($categories as $category)
               {
                    ?><li class="thumbnail"><?php
                    echo $category->getTitle();
                    ?></li><?php
               }
               ?></ul><?php
          }
     } 

     public function _showImages($images)
     {
          if(is_array($images) && $images)
          {
          if(count($images)>1)
          { ?>
          <script type="text/javascript">
          $(function(){
               $("#product-image-line li img").on("click", function(){
                    $("#product-img").attr("src", $(this).attr("data-src"));
               })
          })
          </script>
          <div style="overflow: hidden; border: 1px solid green;">
          <div class="col-md-2">
          <ul style="list-style-type: none; padding: 0;" id="product-image-line">
               <?php foreach($images AS $image) { ?>
                    <li style="margin: 10px auto;">
                         <?php $this
                                   ->view
                                   ->FileStorageHelper()
                                   ->showSmallFile($image); ?>                         
                    </li>
               <?php } ?>
          </ul>
          </div>
          <div class="col-md-10">
               <?php $this->view->FileStorageHelper()->showLargeFile($images); ?>
          </div>
          </div>
          <?php           
          }
          else $this->view->FileStorageHelper()->showLargeFile($images); 
               
          }
     }  

     public function showImages($images)
          {
               ?>
               <div id="product-img-div">
               <?php
               $this->view->FileStorageHelper()->showLargeFile($images);              
               if(is_array($images) && count($images)>1)
               { ?>
               <script type="text/javascript">
               $(function(){
                    $("#product-image-line li img").on("click", function(){
                         $("#product-img-div img").attr("src", $(this).parent().attr("href"));
                    })
               })
               </script>
               <ul style="list-style-type: none; padding: 0;" id="product-image-line">
                    <?php foreach($images AS $image) { ?>
                         <li style="margin: auto;">
                              <a href="<?=$image['small_file_path'] ?>">
                              <?php $this
                                        ->view
                                        ->FileStorageHelper()
                                        ->showSmallFile($image); ?>                         
                         </a>
                         </li>
                    <?php } ?>
               </ul>
               <?php   
               }
                ?></div><?php
          }          
}