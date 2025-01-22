<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>To Do List Sign Up</title>
</head>
<body class="flex flex-col items-center min-h-screen">
    <h1 class="text-center text-[300px] absolute">TO-DO LIST</h1>
    <main class="flex flex-grow flex-col justify-center items-center">
        <div class="bg-white w-[300px] sm:w-[300px] h-[320px] sm:h-[430px]">
            <div class="bg-[#0a779b] w-full h-[50px] sm:h-[80px] flex justify-center items-center">
                <h2 class="text-[20px] sm:text-[40px] text-white">SIGN UP</h2>
            </div>
            <div class="mt-[20px]">
                <form action="../../backend/registration.php" method="POST" class="flex flex-col items-center">
                    <input type="text" name="username" placeholder=" Username"  required>
                    <input type="password" name="password" placeholder=" Password"   required>
                    <a href="index.php">Already have an account?</a>
                    <button class="p-2 bg-[rgb(216,_216,_216)] transition-all mt-[30px] duration-800 hover:bg-[rgb(170,_170,_170)]">Sign Up</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="bottom-[0] bg-white h-[100px]"></footer>
</body>
</html>