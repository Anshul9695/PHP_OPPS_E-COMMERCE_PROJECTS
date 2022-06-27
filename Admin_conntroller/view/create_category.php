<?php
include 'database.php';
include 'header.php';


$errors = array(); 

if(isset($_POST['create'])){
    $category_name=isset($_POST['category_name'])?$_POST['category_name']:NULL;
    $category_description=isset($_POST['discription'])?$_POST['discription']:NULL;

    if (empty($category_name)) { array_push($errors, "Category Name is Required.."); }
    if (empty($category_description)) { array_push($errors, "Category Description is Required.."); }
    if(count($errors)==0){
        $result=$Database->create_category($category_name,$category_description);
        if($result){
          header("location:create_category.php");
        }else{
            array_push($errors,"Category Already Exist..In DataBase.");
        }
        
    }else{
        array_push($errors, "Fill The all Field then submit the form.."); 
    }
}
?>

<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Dashboard</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">create_category</li>
                            </ul>
                        </div>
                        <button class="au-btn au-btn-icon au-btn--green">
                            <i class="zmdi zmdi-plus"></i>add item</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div>
<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
                    </div>
                <form method="post" action="create_category.php">
 
  	<div class="input-group">
  	  <label>Category_Name:</label>
  	  <input type="text" name="category_name" >
  	</div>
  	<div class="input-group">
  	  <label>Category_discription</label>
  	  <input type="text" name="discription" >
  	</div>
  
  	<div class="input-group">
  	  <button type="submit" class="btn" name="create">Create Category</button>
  	</div>
  </form>
                </div>
            </div>
        </div>
    </div>
</section>


</div>

</div>
<?php
include 'footer.php';
?>