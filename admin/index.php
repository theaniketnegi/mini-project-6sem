<?php 
session_start();
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
        <a href="index.php?logout=1" class="text-sm font-medium hover:underline underline-offset-4">Logout</a>
      </nav>
	  <p>
		Welcome <?php echo $_SESSION["username"] ?>  
	</p>
    </header>
    <main class="flex-1 flex justify-center items-center">
		<?php
			if(isset($_GET["candidatesPage"])){

			} else if(isset($_GET["logout"])){
				session_destroy();
				session_unset();
				?>
				<script>location.assign("../index.php");</script>
				<?php
			} else {
				?>			
				<div class="grid grid-cols-12">
					<div class="col-span-4 p-12">
						<h3 class="font-bold text-lg">Add new election</h3>
						<form action="#" method="POST" class="mt-4">
							<div class="mb-4">
								<label class="block text-gray-600">Election title</label>
								<input type="text" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off" name="ele_title" required />
							</div>
							<div class="mb-4">
								<label class="block text-gray-600">Number of candidates?</label>
								<input type="text" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off" name="ele_candidates" required />
							</div>
							<div class="mb-4">
								<label class="block text-gray-600">Starting date</label>
								<input type="date" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"  name="ele_s_date" required />
							</div>
							<div class="mb-4">
								<label class="block text-gray-600">Ending date</label>
								<input type="date" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="ele_e_date" required />
							</div>
							<?php
							if(isset($_GET['added'])){
								?><div class="bg-emerald-600 rounded-lg p-2 mt-4 font-semibold text-white text-center mb-2">Added new election</div>
							<?php	
							} else if(isset($_GET['invalid_date'])){
								?>
								<div class="bg-red-600 rounded-lg p-2 mt-4 font-semibold text-white text-center mb-2">End date should be greater</div>

								<?php
							}
							?>
							<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full" name="ele_add">Add election</button>
					</form>
					</div>
					<div class="col-span-8 p-12">
						<h3 class="font-bold text-lg">Elections</h3>
						<table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
							<thead>
								<tr>
								<th scope="col" class="px-4 py-3 text-start">S. No.</th>
								<th scope="col" class="px-4 py-3 text-start">Title</th>
								<th scope="col" class="px-4 py-3 text-start"># Candidates</th>
								<th scope="col" class="px-4 py-3 text-start">Start date</th>
								<th scope="col" class="px-4 py-3 text-start">End date</th>
								<th scope="col" class="px-4 py-3 text-start">Status</th>
								<th scope="col" class="px-4 py-3 text-start">Action</th>
								</tr>
							</thead>
							<tbody class="">
								<?php
									
									$fetchingData = mysqli_query($db, "SELECT*FROM elections WHERE inserted_by='".$_SESSION["username"]."'") or die(mysqli_error($db));
									if(isset($_GET['deleted'])){
										?>
										<tr>
											<td colspan="7" class="bg-emerald-600 rounded-lg p-2 mt-4 font-semibold text-white text-center mb-2">Deleted election</td>
									</tr>
										<?php
									}
									if(mysqli_num_rows($fetchingData)>0){
										
										while($row = mysqli_fetch_assoc($fetchingData)){
											?>
												<tr>
												<td class="px-4 py-3 whitespace-nowrap text-sm "><?php echo $row["id"]; ?></td>
													<td class="px-4 py-3 whitespace-nowrap text-sm ">
														<?php echo $row["title"]; ?>
													</td>
													<td class="px-4 py-3 whitespace-nowrap text-sm ">
													<?php echo $row["num_candidates"]; ?>
													</td>
													<td class="px-4 py-3 whitespace-nowrap text-sm "><?php echo $row["starting_date"]; ?></td>
													<td class="px-4 py-3 whitespace-nowrap text-sm "><?php echo $row["ending_date"]; ?></td>
													<td class="px-4 py-3 whitespace-nowrap text-sm "><?php echo $row["status"]==1?"Active":"Inactive"; ?></td>
													<td class="px-4 py-3 whitespace-nowrap text-sm ">
														<a href="index.php?delete=<?php echo $row['id'] ?>">Delete</a>
													</td>
												</tr>
											<?php
										}
									} else {
										?>
										<tr>
											<td colspan="7">No elections added yet</td>
										</tr>
										<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				
				<?php
			}	
		?>

	</main>
    <footer class="bg-muted text-muted-foreground px-4 lg:px-6 py-6 flex flex-col lg:flex-row items-center justify-between gap-4">
      <div class="flex items-center w-full justify-center gap-2">
        <span>&copy; Copyright 2024. All rights reserved.</span>
      </div>
    </footer>
  </div>
</body>
</html>


<?php 		
	if(isset($_POST["ele_add"])){
		$title = $_POST["ele_title"];
		$num_candidates = $_POST["ele_candidates"];
		$s_date = $_POST["ele_s_date"];
		$e_date = $_POST["ele_e_date"];
		$inserted_by = $_SESSION["username"];
		$inserted_on = date("Y-m-d");
		
		if($e_date<$s_date){
			?>
			<script>location.assign("index.php?invalid_date=1")</script>
			<?php
		}

		$diff = date_diff(date_create($inserted_on), date_create($s_date));
		if($diff->format("%R%a")>0){
			$status = false;
		} else {
			$status = true;
		}

		mysqli_query($db, "INSERT INTO elections (title, num_candidates, starting_date, ending_date, status, inserted_by, inserted_on) VALUES ('".$title."', '".$num_candidates."', '".$s_date."', '".$e_date."', '".$status."', '".$inserted_by."', '".$inserted_on."')") or die(mysqli_error($db));
		?>
		<script>location.assign("index.php?added=1")</script>
		<?php
	} else if(isset($_GET["delete"])){
		$id = $_GET["delete"];
		mysqli_query($db, "DELETE FROM elections WHERE id='".$id."'") or die(mysqli_error($db));
		?>
		<script>location.assign("index.php?deleted=1")</script>
		<?php
	}
?>
