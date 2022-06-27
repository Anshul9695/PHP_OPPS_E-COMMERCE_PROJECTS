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
                                <li class="list-inline-item">Category List</li>
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


                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Category ID</th>
                                        <th>Category Name</th>
                                        <th>Category Description</th>
                                        
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      
                                        $result = $Database->category_list();
                                        if($result)
                                        {
                                            foreach($result as $row)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $row['category_id'] ?></td>
                                                    <td><?= $row['category_name'] ?></td>
                                                    <td><?= $row['category_discription'] ?></td>
                                                 
                                                    <td>
                                                        <a href="student-edit.php?id=<?=$row['category_id'];?>" class="btn btn-success">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="codes/student-code.php" method="POST">
                                                            <button type="submit" name="deleteStudent" value="<?=$row['category_id'] ?>" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No Record Found";
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>





                
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