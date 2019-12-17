
<style>
    .error{
   position:absolute; 
   left:26vw;top:3vh;
    width:50vw;
   background:red;
 
   padding:3vw;
  
    text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px #666600;font-size:20px;
    
    -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
    -webkit-animation-duration: 10s; /* Safari 4.0 - 8.0 */
    animation-name: example;
    animation-duration: 6s;     
    animation-iteration-count: infinite;
}
    /* animating font */
    @-webkit-keyframes example {
        0%   {color: red;   background:transparent;}
        10%  {color:white;   background:transparent;}
        25%  {color: yellow;   background:transparent;}
        50%  {color: blue;   background:transparent;}
        100% {color: green;   background:transparent;}
    }
    
    /* Standard syntax */
    @keyframes example {
        0%   {color: red;   background:transparent;}
        10%  {color:white;   background:transparent;}
        25%  {color: yellow;   background:transparent;}
        50%  {color: blue;   background:transparent;}
        100% {color: green;   background:transparent;}
      }

    }
 

</style>
<link rel="stylesheet" href="../views/css/bootstrap.min.css">
  <body style="background:url(images/restricted.png);
   

   background-size: cover;
   opacity: 0.8;
    filter: alpha(opacity=70);
   ">
    
<h1 class="error"><center><h1 style="font-size:3.5vw;">YOUR ACCOUNT HAS BEEN DELETED YOU ARE NOT AUTHORIZED TO LOGIN UNLESS SOMEONE CREATES YOU</h1></center></h1>
<td><a class="btn btn-info" style="position:relative; left:48vw; font-size:20px; top:51vh;opacity:0.6;" href="verifylogin.php?login=failed" title="click to login" onclick="return confirm('ARE YOU WANT TO LOGIN take note: If you want to create your account you need a registered user');return confirm('TAKE');"><span class="glyphicon glyphicone-edit"></span>LOGIN</a></td>
               
</body>
<?php



?>
