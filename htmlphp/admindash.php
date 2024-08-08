<?php
include("dbconn.php");
session_start();
$sql1 = "SELECT COUNT(*) AS total_slots FROM slotdetails";
$sql2 = "SELECT COUNT(*) AS total_users FROM useraccs";
$totslots1=mysqli_query($conn,$sql1);
$totusers1=mysqli_query($conn,$sql2);
$row1=mysqli_fetch_assoc($totusers1);
$row2=mysqli_fetch_assoc($totslots1);
$totusers = $row1['total_users'];
$totslots = $row2['total_slots'];

$sql_users = "SELECT * FROM useraccs";
$result_users = mysqli_query($conn, $sql_users);

$sql_slots = "SELECT * FROM slotdetails";
$result_slots = mysqli_query($conn, $sql_slots);

$sql_reserv = "SELECT * FROM reservationdetails";
$result_reserv = mysqli_query($conn, $sql_reserv);

$sql_adm = "SELECT * FROM adminaccs";
$result_adm = mysqli_query($conn, $sql_adm);

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['username'])) {
    $userName = $_GET['username'];
    $sql_delete = "DELETE FROM useraccs WHERE username = '$userName'";
    mysqli_query($conn, $sql_delete);
    // Redirect back to user list after deletion
    header("Location: admindash.php");
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['resid'])) {
    $resId = $_GET['resid'];
    $sql_delete = "DELETE FROM reservationdetails WHERE resid = '$resId'";
    mysqli_query($conn, $sql_delete);
    // Redirect back to user list after deletion
    header("Location: admindash.php");
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['adminname'])) {
    $adminName = $_GET['adminname'];
    $sql_delete = "DELETE FROM adminaccs WHERE adminname = '$adminName'";
    mysqli_query($conn, $sql_delete);
    // Redirect back to user list after deletion
    header("Location: admindash.php");
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['username'])) {
    $userName = $_GET['username'];
    $sql_delete = "DELETE FROM useraccs WHERE username = '$userName'";
    mysqli_query($conn, $sql_delete);
    // Redirect back to user list after deletion
    header("Location: admindash.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminName = $_POST['adminname'];
    $adminPass = $_POST['adminpass'];
    $sql_add = "INSERT INTO adminaccs (adminname, adminpass) VALUES ('$adminName', '$adminPass')";
    mysqli_query($conn, $sql_add);
    header("Location: admindash.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="../css/admindash.css">
</head>
<body>
    
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span>ParkEasy</span>
            </h3> 
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="#" id="home-link">
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="#" id="userlist-link">
                        <span class="ti-face-smile"></span>
                        <span>User List</span>
                    </a>
                </li>
                <li>
                    <a href="#" id="slotlist-link">
                        <span class="ti-agenda"></span>
                        <span>Slot List</span>
                    </a>
                </li>
                <li>
                    <a href="#" id="reservation-history-link">
                        <span class="ti-clipboard"></span>
                        <span>Reservation History</span>
                    </a>
                </li>
                <li>
                    <a href="#" id="admin-management-link">
                        <span class="ti-folder"></span>
                        <span>Admin Management</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="ti-time"></span>
                        <span><a href="adminlogout.php">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="admin-info">
            <?php if(isset($_SESSION["adminloggedin"])&&$_SESSION["adminloggedin"]===true):?>
                <span><?php echo '😎'.htmlspecialchars($_SESSION["adminname"])?></span>
            <?php else:?>
                <button class="admlogin"><a href="adminlogin.html">Login</a></button>
            <?php endif; ?>
            </div>
            <!-- <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
            </div> -->
            
            <!-- <div class="social-icons">
                <span class="ti-bell"></span>
                <span class="ti-comment"></span>
                <div></div>
            </div> -->
        </header>
        
        <main>
            
            <div id="overview-section">
                <h2 class="dash-title">Overview</h2>
                
                <div class="dash-cards">
                    <div class="card-single">
                        <div class="card-body">
                            <div>
                                <h5>Total Slots</h5>
                                <h4><?php echo $totslots;?></h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-single">
                        <div class="card-body">
                            <div>
                                <h5>Total Users</h5>
                                <h4><?php echo $totusers;?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="userlist-section" style="display:none;">
                <h2 class="dash-title">User List</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($result_users)) {
                                while($row_user = mysqli_fetch_assoc($result_users)) {
                                    echo "<tr>";
                                    echo "<td>" . $row_user['username'] . "</td>";
                                    echo "<td>" . $row_user['email'] . "</td>";
                                    echo "<td><a href='admindash.php?action=delete&username=" . $row_user['username'] . "' class='delete-btn'>Remove</a></td>";
                                    echo "</tr>";
                                }
                            }
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="slotlist-section" style="display:none;">
                <h2 class="dash-title">Slot List</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Slot No.</th>
                                <th>Vehicle Type</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($result_slots)) {
                                while($row_slot = mysqli_fetch_assoc($result_slots)) {
                                    echo "<tr>";
                                    echo "<td>" . $row_slot['slotno'] . "</td>";
                                    echo "<td>" . $row_slot['vehicletype'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="reservation-history-section" style="display:none;">
                <h2 class="dash-title">Reservation History</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Slot No.</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Slot Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($result_reserv)) {
                                while($row_reserv = mysqli_fetch_assoc($result_reserv)) {
                                    echo "<tr>";
                                    echo "<td>" . $row_reserv['username'] . "</td>";
                                    echo "<td>" . $row_reserv['slotno'] . "</td>";
                                    echo "<td>" . $row_reserv['starttime'] . "</td>";
                                    echo "<td>" . $row_reserv['endtime'] . "</td>";
                                    echo "<td>" . $row_reserv['slotdate'] . "</td>";
                                    echo "<td>" . $row_reserv['status'] . "</td>";
                                    echo "<td><a href='admindash.php?action=delete&resid=" . $row_reserv['resid'] . "' class='delete-btn'>Cancel</a></td>";
                                    echo "</tr>";
                                }
                            }
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="admin-management-section" style="display:none;">
                <h2 class="dash-title">Admin Management</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Admin ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($result_adm)) {
                                while($row_adm = mysqli_fetch_assoc($result_adm)) {
                                    echo "<tr>";
                                    echo "<td>" . $row_adm['adminid'] . "</td>";
                                    echo "<td>" . $row_adm['adminname'] . "</td>";
                                    echo "<td><a href='admindash.php?action=delete&adminname=" . $row_adm['adminname'] . "' class='delete-btn'>Remove</a></td>";
                                    echo "</tr>";
                                }
                            }
                           ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <!-- <h2 class="dash-title">Admin Management</h2> -->
                <form id="addadminform" class="addadminform" action="admindash.php" method="post">
                    <h2>Add Admin</h2>
                    <input type="text" id="adminname" class="forminputs" name="adminname" placeholder="Admin Name" required><br>
                    <input type="password" id="adminpass" class="forminputs" name="adminpass" placeholder="Admin Password" required><br>
                    <button type="submit" class="btn">Submit</button>
                    <!-- <a href='admindash.php?action=add' class='btn'>Submit</a> -->
                </form>
            </div>
            <!-- <div id="adminadd" style="display:none;">
                <h2 class="dash-title">Admin Management</h2>
                <form id="add-admin-form" class="hidden">
                    <input type="text" id="adminname" name="adminname" placeholder="Admin Name" required>
                    <input type="password" id="adminpass" name="adminpass" placeholder="Admin Password" required>
                    <button type="submit">Submit</button>
                </form>
            </div> -->

            
        </main>
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const homeLink = document.getElementById('home-link');
            const userlistLink = document.getElementById('userlist-link');
            const slotlistLink = document.getElementById('slotlist-link');
            const reservationHistoryLink = document.getElementById('reservation-history-link');
            const adminManagementLink = document.getElementById('admin-management-link');

            const overviewSection = document.getElementById('overview-section');
            const userlistSection = document.getElementById('userlist-section');
            const slotlistSection = document.getElementById('slotlist-section');
            const reservationHistorySection = document.getElementById('reservation-history-section');
            const adminManagementSection = document.getElementById('admin-management-section');

            const sections = [overviewSection, userlistSection, slotlistSection, reservationHistorySection, adminManagementSection];

            function showSection(section) {
                sections.forEach(sec => sec.style.display = 'none');
                section.style.display = 'block';
            }

            homeLink.addEventListener('click', function() {
                showSection(overviewSection);
            });

            userlistLink.addEventListener('click', function() {
                showSection(userlistSection);
            });

            slotlistLink.addEventListener('click', function() {
                showSection(slotlistSection);
            });

            reservationHistoryLink.addEventListener('click', function() {
                showSection(reservationHistorySection);
            });

            adminManagementLink.addEventListener('click', function() {
                showSection(adminManagementSection);
            });

            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                if (![homeLink, userlistLink, slotlistLink, reservationHistoryLink, adminManagementLink].includes(link)) {
                    link.addEventListener('click', function() {
                        sections.forEach(sec => sec.style.display = 'none');
                    });
                }
            });
        });
    </script>
    
</body>
</html>
