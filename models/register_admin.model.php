<?php

require_once '../config/db.config.php';

class Register extends Database {
   // Registration query for new user.
   public static function registerUser( $username,$hashed_pwd,$person,$ip_address,$mac_address,$role ) {

      try {

         return self::sql(
            'INSERT INTO security( username,pwd,nameofuser,ip_users,mac_user,role_type,date_created) VALUES(?, ?, ?, ?, ?,?,NOW())',
            [
               $username,$hashed_pwd,$person,$ip_address,$mac_address,$role
            ]
         );

      } catch ( PDOException $e ) {

         die( "Something went wrong. STOP CYBER CRIME". $e->getMessage() );
         exit;
      }
   }
   // If user is trying to register existing username, it will be blocked then.
   public static function countUid( $username ) {

      try {

         $sql = 'SELECT username FROM security WHERE username = ?';
         if ( $stmt = self::conn()->prepare($sql) ) {

            $stmt->execute( [$username] );
            return $stmt;
         }

      } catch ( PDOException $e ) {

         die( "Something went wrong. STOP CYBER CRIME". $e->getMessage() );
         exit;
      }
      unset($stmt);
   }
   // If user is trying to register existing email, it will be blocked then.
   // public static function countEmail( $email ) {

   //    try {

   //       $sql = 'SELECT email FROM users WHERE email = ?';
   //       if ( $stmt = self::conn()->prepare($sql) ) {

   //          $stmt->execute( [$email] );
   //          return $stmt;
   //       }

   //    } catch ( PDOException $e ) {

   //       die( "Something went wrong. STOP CYBER CRIME". $e->getMessage() );
   //       exit;
   //    }
   //    unset($stmt);
   // }
}