<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<script type="text/javascript" src="./../assets/jquery/jquery-3.6.3.min.js"></script>
 
<?php
@include '../include/connection.php';
// session_start();
$idno=$_SESSION['idno'];
?>

 <div class="side-bar">
  <?php
  $profile=mysqli_query($conn,"SELECT * from admin where Id_No='$idno'");
  if (mysqli_num_rows($profile)>0) {
    while ($fetch_image=mysqli_fetch_assoc($profile)) {
      ?>
      <header id="header">
        <img src="./../assets/images/admin/<?php echo $fetch_image['image'];  ?>">
        <h1><?php echo $fetch_image['Name'];  ?></h1>
      </header>
      <?php
    };
  };
  ?>

   <div class="menu">
     <div class="item"><a href="./index.php"><i class="fas fa-desktop"></i>Dashboard</a></div>
     
     <div class="item"><a href="./positions.php"><i class="fas fa-desktop"></i>Positions</a></div>
     <div class="item">
       <a class="sub-btn"><i class="fas fa-table"></i>Registered parties<i class="fas fa-angle-right dropdown"></i></a>
       <div class="sub-menu">
         <a href="./view-party.php" class="sub-item">View</a>
         <a href="./addparty.php" class="sub-item">Add party</a>
         <!-- <a href="#" class="sub-item">Sub Item 03</a> -->
       </div>
     </div>

     <div class="item">
       <a class="sub-btn"><i class="fas fa-table"></i>Counties<i class="fas fa-angle-right dropdown"></i></a>
       <div class="sub-menu">
         <a href="./counties.php" class="sub-item">View</a>
         <a href="./add-county.php" class="sub-item">Add county</a>
         <!-- <a href="#" class="sub-item">Sub Item 03</a> -->
       </div>
     </div>
     <div class="item">
       <a class="sub-btn"><i class="fas fa-table"></i>Voters<i class="fas fa-angle-right dropdown"></i></a>
       <div class="sub-menu">
         <a href="./voter.php" class="sub-item">View</a>
         <a href="./add-voter.php" class="sub-item">Register</a>
         <!-- <a href="#" class="sub-item">Sub Item 03</a> -->
       </div>
     </div>
     <div class="item">
       <a class="sub-btn"><i class="fas fa-table"></i>Candidates<i class="fas fa-angle-right dropdown"></i></a>
       <div class="sub-menu">
         <a href="./candidates.php" class="sub-item">View</a>
         <a href="./add-candidate.php" class="sub-item">Register</a>
         <!-- <a href="#" class="sub-item">Sub Item 03</a> -->
       </div>
     </div>

     <div class="item"><a href="#"><i class="fas fa-th"></i>Registration</a></div>
     <!-- <div class="item">
       <a class="sub-btn"><i class="fas fa-cogs"></i>Counties<i class="fas fa-angle-right dropdown"></i></a>
       <div class="sub-menu">
         <a href="#" class="sub-item">Sub Item 01</a>
         <a href="#" class="sub-item">Sub Item 02</a>
       </div>
     </div> -->
     <div class="item"><a href="#"><i class="fas fa-info-circle"></i>About Us</a></div>
   </div>
 </div>
 
 <script type="text/javascript">
 $(document).ready(function(){
   //jquery for toggle sub menus
   $('.sub-btn').click(function(){
     $(this).next('.sub-menu').slideToggle();
     $(this).find('.dropdown').toggleClass('rotate');
   });

   //jquery for expand and collapse the sidebar
   $('.menu-btn').click(function(){
     $('.side-bar').addClass('active');
     $('.menu-btn').css("visibility", "hidden");
   });

   $('.close-btn').click(function(){
     $('.side-bar').removeClass('active');
     $('.menu-btn').css("visibility", "visible");
   });
 });
 </script>
