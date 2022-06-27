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
                                <li class="list-inline-item">User List</li>
                            </ul>
                        </div>
                        <button class="au-btn au-btn-icon au-btn--green">
                            <i class="zmdi zmdi-plus"></i><a href="register.php" > Add New User </a></button>
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
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                       
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      
                                        $result = $Database->user_list();
                                        if($result)
                                        {
                                            foreach($result as $row)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['user_name'] ?></td>
                                                    <td><?= $row['email'] ?></td>
                                                 
                                                    <td>
                                                        <a href="student-edit.php?id=<?=$row['id'];?>" class="btn btn-success">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="codes/student-code.php" method="POST">
                                                            <button type="submit" name="deleteStudent" value="<?=$row['id'] ?>" class="btn btn-danger">Delete</button>
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