         <style>
             hr.new1 {
                border: 1px solid red;
                }
           
         </style>

         <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <!-- <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div> -->
                        <h3></h3>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                       
                        <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge">
                                <?php
                                
                                $res1 = mysqli_query($conn,"SELECT * FROM policy_notification");
                                $nm_rows1=mysqli_num_rows($res1);

                                $res2 = mysqli_query($conn,"SELECT * FROM emi2_notification");
                                $nm_rows2=mysqli_num_rows($res2);

                                $res3 = mysqli_query($conn,"SELECT * FROM emi3_notification");
                                $nm_rows3=mysqli_num_rows($res3);

                                $total_res =$nm_rows1+$nm_rows2+$nm_rows3;
                                echo $total_res;
                                ?>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-right">
                                        <a href="notification_delete.php" class="text-dark" id="noti_delete" type="button">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>
                           
                            

                            <div style="overflow: auto;height:250px;width:300px;">
                            <?php 
                                
                                $res1 = mysqli_query($conn,"SELECT policy_reminder_email FROM policy_notification");
                           
                                $nm_rows1=mysqli_num_rows($res1);
                                 if($nm_rows1>0){
                                     while($rows = mysqli_fetch_assoc($res1)){
                                         
                             
                                ?>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                       </div>
                                    <p class="notify-details"><b>Email sent for policy reminder:-</b></p>
                                    
                                    <p class="text-muted mb-0 user-msg">
                                        <small class="text-dark">
                                            <?php
                                             if(isset($rows['policy_reminder_email'])){
                                                echo $rows['policy_reminder_email'];
                                            }else{
                                                echo "NULL";
                                            }
                                            ?>
                                        </small>
                                    </p>
                                    <hr class="new1">
                                </a>
                                <?php
                                    }
                                    }
                                ?> 

                            <?php 
                                
                                $res1 = mysqli_query($conn,"SELECT emi2_reminder_email FROM emi2_notification");
                           
                                $nm_rows1=mysqli_num_rows($res1);
                                 if($nm_rows1>0){
                                     while($rows = mysqli_fetch_assoc($res1)){
                          
                                  
                                ?>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                       </div>
                                    <p class="notify-details"><b>Email sent for EMI2 reminder:-</b></p>
                                    
                                    <p class="text-muted mb-0 user-msg">
                                        <small class="text-dark">
                                            <?php
                                        if(isset($rows['emi2_reminder_email'])){
                                            echo $rows['emi2_reminder_email'];
                                        }else{
                                            echo "NULL";
                                        }
                                            ?>
                                        </small>
                                    </p>
                                    <hr class="new1">
                                </a>
                                <?php
                                    }
                                    }
                                ?> 
 
                                
                             <?php 
                                
                                $res1 = mysqli_query($conn,"SELECT emi3_reminder_email FROM emi3_notification");
                           
                                $nm_rows1=mysqli_num_rows($res1);
                                 if($nm_rows1>0){
                                     while($rows = mysqli_fetch_assoc($res1)){
                               
                                ?>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                       </div>
                                    <p class="notify-details"><b>Email sent for EMI3 reminder:-</b></p>
                                    
                                    <p class="text-muted mb-0 user-msg">
                                        <small class="text-dark">
                                            <?php
                                            
                                            if(isset($rows['emi3_reminder_email'])){
                                                echo $rows['emi3_reminder_email'];
                                            }else{
                                                echo "NULL";
                                            }
                                            ?>
                                        </small>
                                    </p>
                                    <hr class="new1">
                                </a>
                                <?php
                                    }
                                    }
                                ?> 
                                
                                
                            </div>
                            

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Gaurav Goel</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                