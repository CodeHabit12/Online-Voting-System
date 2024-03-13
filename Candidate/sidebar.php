<link rel="stylesheet" type="text/css" href="./../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<script type="text/javascript" src="./../assets/jquery/jquery-3.6.3.min.js"></script>
 
<?php
@include '../include/connection.php';
// session_start();
$idno=$_SESSION['idno'];
?>

 <div class="side-bar">
  <?php
  $profile=mysqli_query($conn,"SELECT * from candidate, id_table where candidate.IdentityNo ='$idno' and candidate.IdentityNo=id_table.IdentityNo");
  if (mysqli_num_rows($profile)>0) {
    while ($fetch_image=mysqli_fetch_assoc($profile)) {
      ?>
      <header id="header">
        <img src="./../assets/images/candidate/<?php echo $fetch_image['Profile'];  ?>">
        <h1><?php echo $fetch_image['Name'];  ?></h1>
      </header>
      <?php
    };
  };
  ?>

   <div class="menu">
     <div class="item"><a href="./index.php"><i class="fas fa-desktop"></i>Dashboard</a></div>
     <div class="item"><a href="#"><i class="fas fa-cogs"></i>Setting</a></div>
     <div class="item"><a href="contact.php"><i class="fas fa-th"></i>Contact Us</a></div>
     <div class="item"><a href="profile.php"><i class="fas fa-table"></i>My profile</a></div>
     <div class="item"><a href="logout.php"><i class="fas fa-info-circle"></i>Exit</a></div>
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
