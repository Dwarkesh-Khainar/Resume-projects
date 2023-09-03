<?php
session_start();
error_reporting(0);
if($_SESSION['adminLogin']!=1)
{
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Charging Station</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .del,.edit,.verify
        {
            display: block;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .verify
        {
            background-color: royalblue;
        }
        td
        {
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <span class="menu-bar" id="show" onclick="showMenu()">&#9776;</span>
            <span class="menu-bar" id="hide" onclick="hideMenu()">&#9776;</span>
            <span class="logo">Charging Station</span>
            <span class="profile" onclick="showProfile()"><img src="../res/user3.jpg" alt=""><label><?php echo $_SESSION['name']; ?></label></span>
        </div>
        <?php include 'menu.php'; ?>
        <div id="profile-panel">
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()">✕</i>
            <div class="dp"><img src="../res/user3.jpg" alt=""></div>
            <div class="info">
                <h2>SSVPS ADMIN</h2>
                <h5>Admin</h5>
            </div>
            <div class="link"><a href="admin-logout.php" class="del"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></div>
        </div>
        <div id="main">
        <div class="heading"><a href="../registration.php" class="add-btn" onclick="showForm()">+ Add</a><h2>Voters Information</h2></div>
        <div class="heading"><h2 style="background:royalblue;">Users</h2></div>   
        <table class="table">
               <thead>
                    <th>Name</th>
                    <th>Id Number</th>
                    <th>ID Card</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Phone No</th>
                    <th>Email ID</th>
                    <th>Address</th>
                    <th>Action</th>               
               </thead>
               <tbody>
                      <?php
                      
                      $con=mysqli_connect('localhost','root','','charging');
                  
                      $query="SELECT * FROM register";

                      $color="red";
                  
                      $data=mysqli_query($con,$query);
                    
                      while($result=mysqli_fetch_assoc($data))
                      {
                        if($result['verify']=="yes")
                        {
                            $verify="none";
                        }
                        else
                        {
                            $verify="block";
                        }
                        echo "<tr>
                        <td>".$result['fname']." ".$result['lname']."</td>
                        <td><h4>".$result['idname']."</h4>".$result['idnum']."</td>
                        <td><a href='../$result[idcard]'><img src='../".$result['idcard']."'></a></td>
                        <td>".$result['dob']."</td>
                        <td>".$result['gender']."</td>
                        <td>".$result['phno']."</td>
                        <td>".$result['email']."</td>
                        <td>".$result['address']."</td>
                        <td><a href='user-update.php?fn=$result[fname]&ln=$result[lname]&idno=$result[idnum]&ph=$result[phno]&ad=$result[address]&em=$result[email]' class='edit'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                        <a href='user-delete.php?ph=$result[phno]' class='del' onClick='return delconfirm()'><i class='fa-solid fa-trash-can'></i> Delete</a></td>
                        </tr>";
                      }
                      
                      ?>
               </tbody>
           </table>
    </div>
    <script src="../js/script.js"></script>
    <script>
        function delconfirm()
        {
            return confirm('Delete this Voter?');
        }

        function validconfirm()
        {
            return confirm('Validate this Voter?');
        }
    </script>
</body>
</html>