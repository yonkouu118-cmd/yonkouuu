<!-- ================================= -->
<!-- FILE : index.php (HALAMAN LOGIN) -->
<!-- ================================= -->

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Perpustakaan</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(135deg,#4facfe,#00f2fe);
}

.login-card{
    width:380px;
    background:#fff;
    padding:40px 30px;
    border-radius:20px;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
    animation:fadeIn .6s ease;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.login-card h2{
    text-align:center;
    margin-bottom:30px;
    color:#333;
}

.input-box{
    position:relative;
    margin-bottom:20px;
}

.input-box input{
    width:100%;
    padding:14px 45px 14px 15px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
    transition:.3s;
}

.input-box input:focus{
    border-color:#4facfe;
    box-shadow:0 0 8px rgba(79,172,254,.3);
}

.input-box i{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    color:#777;
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    background:linear-gradient(135deg,#4facfe,#00f2fe);
    color:#fff;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

.footer{
    margin-top:20px;
    text-align:center;
    font-size:14px;
}

.footer a{
    color:#1e88e5;
    text-decoration:none;
    font-weight:600;
}
</style>
</head>
<body>

<div class="login-card">
    <h2><i class="fa fa-user-lock"></i> Login Perpustakaan</h2>

    <form action="proseslogin.php" method="POST">

        <div class="input-box">
            <input type="text" name="username" placeholder="Username" required>
            <i class="fa fa-user"></i>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class="fa fa-lock"></i>
        </div>

        <button type="submit" name="submit">
            LOGIN
        </button>

    </form>

    <div class="footer">
        Belum punya akun?
        <a href="register.php">Register</a>
    </div>
</div>

</body>
</html>