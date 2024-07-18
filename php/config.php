<?php
 $conn=new mysqli("localhost","root","","webchatphp");
 if ($conn->connect_error) {
      echo"data connect error". $conn->connect_error;
 }

