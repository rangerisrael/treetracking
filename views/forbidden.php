<style>
    .error{
   position:absolute; 
   left:33.5vw;top:15vw;
    width:30vw;
   background:transparent;
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
  
<body style="background:url(images/restricted.png);
   

    background-size: cover;
    ">
<h1 class="error"><center><h1 style="font-size:3.5vw;">ACCESS DENIED</h1></center></h1>

<td><a class="btn btn-info" style="position:relative; left:48vw; font-size:20px; top:51vh;opacity:0.6;" href="verifylogin.php?login=failed" title="click to login" ><span class="glyphicon glyphicone-edit"></span>LOGIN</a></td>
</body>
<?php


?>
