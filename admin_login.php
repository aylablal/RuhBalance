<?php

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');


session_start();
if (isset($_POST['login'])) {
   // Basit admin kontrolü
   $username = $_POST['username'];
   $password = $_POST['password'];
   
   // Bu bilgileri güvenli bir yerde saklayın
   if ($username === 'mr.big' && $password === 'bizdederiniz::12050101!') {
       $_SESSION['admin_logged_in'] = true;
       $_SESSION['admin_username'] = $username;
       header('Location: eşrefruya_tekpanel.php');
       exit();
   } else {
       $error = "Kullanıcı adı veya şifre hatalı!";
   }
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>RuhaBalance Admin Giriş</title>
   <style>
       body { font-family: Arial; background: #667eea; }
       .login-box { 
           max-width: 400px; margin: 100px auto; 
           background: white; padding: 40px; border-radius: 10px; 
       }
       input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; }
       button { width: 100%; padding: 10px; background: #667eea; color: white; border: none; }
   </style>
</head>
<body>
   <div class="login-box">
       <h2>Admin Paneli Giriş</h2>
       <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
       <form method="POST">
           <input type="text" name="username" placeholder="Kullanıcı Adı" required>
           <input type="password" name="password" placeholder="Şifre" required>
           <button type="submit" name="login">Giriş Yap</button>
       </form>
   </div>
</body>
</html>