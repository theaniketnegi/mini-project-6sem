<?php 
require_once("middleware.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="flex flex-col min-h-[100dvh]">
    <header class="bg-primary text-primary-foreground px-4 lg:px-6 py-4 flex items-center justify-between">
      <a href="#" class="flex items-center gap-2">
        <span class="text-xl font-bold">Voting system</span>
      </a>
      <nav class="hidden lg:flex items-center gap-6">
        <a href="index.php" class="text-sm font-medium hover:underline underline-offset-4">Elections</a>
        <a href="index.php?candidatesPage=1" class="text-sm font-medium hover:underline underline-offset-4">Candidates</a>
        <a href="<?php session_destroy(); session_unset(); ?>" class="text-sm font-medium hover:underline underline-offset-4">Logout</a>
      </nav>
	  <p>
		Welcome <?php echo $_SESSION["username"] ?>  
	</p>
    </header>
    <main class="flex-1"></main>
    <footer class="bg-muted text-muted-foreground px-4 lg:px-6 py-6 flex flex-col lg:flex-row items-center justify-between gap-4">
      <div class="flex items-center w-full justify-center gap-2">
        <span>&copy; Copyright 2024. All rights reserved.</span>
      </div>
    </footer>
  </div>
</body>
</html>
