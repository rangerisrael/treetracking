<?php

require_once '../config/db.config.php';

class Login extends Database {

   public static function loginUser( $email ) {

      try {

         return self::sql(
            "SELECT id,username,pwd,nameofuser,profile,ip_users,mac_user,role_type,date_created,CURDATE() as dated, CURTIME() as tim FROM security WHERE username = ?",
            [
               $email
            ]
         );

      } catch ( PDOException $e ) {

         die("Connection error: ". $e->getMessage() );
         exit;
      }
   }


  

   public static function getuserlog($id,$user,$person,$ip,$mac){


    try {

        return self::sql(
           "INSERT into login_log(admin_id,username,assigned_name,ip_use,laptop_mac_address,date_time) VALUES(?,?,?,?,?,NOW())",
           
           [
              $id,$user,$person,$ip,$mac
           ]
        );
       
     } catch ( PDOException $e ) {

        die("Connection error: ". $e->getMessage() );
        exit;
     }

   }
}