<?php
include 'database.php';
include 'header.php';
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
                                <li class="list-inline-item">Create Products</li>
                            </ul>
                        </div>
                        <button class="au-btn au-btn-icon au-btn--green">
                            <i class="zmdi zmdi-plus"></i><a href="create_product_list.php"> Show Products On list </a></button>
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
                    <div class="header">
                        <h2>Create Products </h2>
                    </div>
                    <?php
                    $errors = array();
                    if (isset($_POST['create_products'])) {
                        // print_r($_POST);
                        // print_r($_FILES);
                        $product_name = isset($_POST['products_name']) ? $_POST['products_name'] : NULL;
                        $products_description = isset($_POST['products_description']) ? $_POST['products_description'] : NULL;
                        $products_price = isset($_POST['products_price']) ? $_POST['products_price'] : NULL;
                        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : NULL;
                        $product_image = isset($_FILES['product_image']) ? $_FILES['product_image'] : NULL;
                       // var_dump($product_image); 
                        //die;

                        if (empty($product_name)) {
                            array_push($errors, "Fill The Product Name..");
                        }
                        if (empty($products_description)) {
                            array_push($errors, "Product Description is fillable.. ");
                        }
                        if (empty($products_price)) {
                            array_push($errors, "Product Price can't be Empty..");
                        }
                        if (empty($category_id)) {
                            array_push($errors, "Please Select The Category for the Products ....");
                        }
                        if (empty($product_image)) {
                            array_push($errors, "Upload Product Image ....");
                        }

                      if(count($errors)==0){
                          
                        $create_product = $Database->create_products($product_name, $products_description, $products_price, $category_id, $product_image);
                        if ($create_product) {
                            //header("location: create_product_list.php");
                            array_push($errors, "Producd Create Successfully..");
                        } else {
                            array_push($errors, "Errors To Create..");
                        }
                      }else{
                        array_push($errors, "Fill All fieds");
                      }
                    }
                    ?>


                    <form method="post" action="create_products.php" enctype="multipart/form-data">
                        <div>
                            <?php if (count($errors) > 0) : ?>
                                <div class="error">
                                    <?php foreach ($errors as $error) : ?>
                                        <p><?php echo $error ?></p>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="input-group">
                            <label>Products Name:</label>
                            <input type="text" name="products_name">
                        </div>
                        <div class="input-group">
                            <label>Products Description:</label>
                            <input type="text" name="products_description">
                        </div>
                        <div class="input-group">
                            <label>Products Price:</label>
                            <input type="text" name="products_price">
                        </div>

                        <div class="input-group">
                            <label>Select Category</label>
                            <select name="category_id" class="form-control">
                                <option value="select">--Select Your Category--</option>
                                <?php

                                $result = $Database->category_list();
                                if ($result) {
                                    foreach ($result as $row) {
                                ?>
                                        <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?></option>
                                <?php
                                    }
                                } else {
                                    echo "No Record Found";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label>Products Image</label>
                            <input type="file" id="myFile" class="form-control" name="product_image">
                        </div>

                        <div class="input-group">
                            <button type="submit" class="btn" name="create_products" value="create_products">Create Products</button>
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