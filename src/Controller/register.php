<!--  Exercise 3

You work for a cinema and need to create a movie database. Your database will be called "exercise_3". 
You will then need to create a script that will add and display movies. Follow the steps. Follow the steps. 

Step 1 :
This table, named "movies" will consist of the following fields : 
● title (varchar): the name of the movie 
● actors (varchar): the names of actors 
● director (varchar): the name of the director 
● producer (varchar): the name of the producer 
● year_of_prod (year): the year of production 
● language (varchar): the language of the film 
● category (enum): the category of the film 
● storyline (text): the synopsis of the movie 
● video (url): the synopsis of the movie  
 Do not forget to create an ID for each movie and auto-increment. 
 cf. fichier exercise3_database.sql
 


<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Step 2 : Create a form to add a movie and make the necessary checks.
    
    $title = $_POST['title'] ?? null;
    $actors = $_POST['actors'] ?? null;
    $director = $_POST['director'] ?? null;
    $producer = $_POST['producer'] ?? null;
    $year_of_prod = $_POST['year_of_prod'] ?? null;
    $language = $_POST['language'] ?? null;
    $category = $_POST['category'] ?? null;
    $storyline = $_POST['storyline'] ?? null;
    $video = $_POST['video'] ?? null;
    
    echo 'Validate data' . "<br>";
    //Prerequisites : ● The fields "title, name of the director, actors, producer and synopsis" will have at least 5 characters.
    $titleSuccess = (is_string($title) && strlen($title) > 4);
    $directorSuccess = (is_string($director) && strlen($director) > 4);
    $actorsSuccess = (is_string($actors) && strlen($actors) > 4);
    $producerSuccess = (is_string($producer) && strlen($producer) > 4);
    $storylineSuccess = (is_string($storyline) && strlen($storyline) > 4);
    $videoSuccess = (filter_var($video, FILTER_VALIDATE_URL));
    $languageSuccess = (isset($_POST['language']));
    $categorySuccess = (isset($_POST['category']));
    $year_of_prodSuccess = (isset($_POST['year_of_prod']));

    if ($titleSuccess && $directorSuccess && $actorsSuccess && $producerSuccess && $storylineSuccess && $videoSuccess) {
        try {
            $connection = Service\DBConnector::getConnection();
        } catch (PDOException $exception) {
            http_response_code(500);
            echo 'A problem occured, contact support';
            //exit(10);
        }
        
        $sql = "INSERT INTO movie(title, actors, director, producer, year_of_prod, language, category, storyline, video) 
                VALUES (:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)";
        $statement = $connection->prepare();
        $statement->bindValue('title', $title, PDO::PARAM_STR);
        $statement->bindValue('actors', $actors, PDO::PARAM_STR);
        $statement->bindValue('director', $director, PDO::PARAM_STR);
        $statement->bindValue('producer', $producer, PDO::PARAM_STR);
        $statement->bindValue('year_of_prod', $year_of_prod, PDO::PARAM_INT);
        $statement->bindValue('language', $language, PDO::PARAM_STR);
        $statement->bindValue('category', $category, PDO::PARAM_STR);
        $statement->bindValue('storyline', $storyline, PDO::PARAM_STR);
        $statement->bindValue('video', $video, PDO::PARAM_STR);
        if($statement->execute()) {
            echo 'INSERT FAILED';
        }
    }
}	

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a movie</title>
    </head>
    <body>
    
    <!-- Step 2 : Create a form to add a movie and make the necessary checks.
         Prerequisites : ● The fields "title, name of the director, actors, producer and synopsis" will have at least 5 characters.     -->

    	<form action="/src/Controller/register.php" method="POST">
    		<?php if (!($titleSuccess ?? true)) {?>
    		<div>
    			<p style="color:red;"> You have an error into the title</p>
    		</div>
    		<?php }?>
    		<label for="title">Movie title :</label>
    		<input type="text" name="title" value="<?php echo htmlentities($title ?? '')?>"/> 		
    		<br/>
    		
    		<?php if (!($actorsSuccess ?? true)) {?>
    		<div>
    			<p style="color:red;"> You have an error into actors</p>
    		</div>
    		<?php }?>
			<label for="actors">Actors :</label>
    		<input type="text" name="actors" value="<?php echo htmlentities($actors ?? '')?>"/>   		
    		<br/>
    		<?php if (!($directorSuccess ?? true)) {?>
    		<div>
    			<p style="color:red;"> You have an error into the Director name</p>
    		</div>
    		<?php }?>
    		<label for="director">Director :</label>
    		<input type="text" name="director" value="<?php echo htmlentities($director ?? '')?>"/>   		
    		<br/>
    		<?php if (!($producerSuccess ?? true)) {?>
    		<div>
    			<p style="color:red;"> You have an error into the Producer name</p>
    		</div>
    		<?php }?>
    		<label for="producer">Producer :</label>
    		<input type="text" name="producer" value="<?php echo htmlentities($producer ?? '')?>"/>    		
    		<br/>
    		
    		<select name="year_of_prod">
    		  <option value="">Choose year</option>
              <option value="2010">Year 2010</option>
              <option value="2011">Year 2011</option>
              <option value="2012">Year 2012</option>
              <option value="2013">Year 2013</option>
            </select>
            <br/>		
    		
    		<select name="language">
    		  <option value="">Choose language</option>    		
              <option value="english">English</option>
              <option value="french">French</option>
              <option value="luxemburgish">luxemburgish</option>
              <option value="german">german</option>
            </select>
            <br/>	
    		
    		<select name="category">
    		  <option value="">Choose category</option>    		
              <option value="Action">Action</option>
              <option value="Romance">Romance</option>
              <option value="Horror">Horror</option>
              <option value="SF">SF</option>
            </select>
            <br/>
            
            <?php if (!($storylineSuccess ?? true)) {?>
    		<div>
    			<p style="color:red;"> You have an error into the Synopsis</p>
    		</div>
    		<?php }?>
            <label for="storyline">Producer :</label>
    		<input type="text" name="storyline" value="<?php echo htmlentities($storyline ?? '')?>"/>   		
    		<br/>
    		
    		<?php if (!($videoSuccess ?? true)) {?>
    		<div>
    			<p style="color:red;"> You have an error into the Video Url</p>
    		</div>
    		<?php }?>
    		<label for="video">Trailer :</label>
    		<input type="text" name="video" value="<?php echo htmlentities($video ?? '')?>"/>   		
    		<br/>
    		
    		<button type="submit">Send</button>
    	</form>
    </body>
</html>