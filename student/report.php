<?php



if ($_SERVER["REQUEST_METHOD"] =="POST"){
   $student_name = htmlspecialchars($_POST["student-name"]);
   $organization = htmlspecialchars($_POST["organization"]);
   $duration = htmlspecialchars($_POST["duration"]);
   $overview = htmlspecialchars($_POST["overview"]);
   $skills_acquired = htmlspecialchars($_POST["skills-acquired"]);
   $challenges = htmlspecialchars($_POST["challenges"]);
   $future_goals = htmlspecialchars($_POST["future-goals"]);
  
   echo "These are the data, that the user submitted";
   echo "<br>";
   echo $student_name;
   echo "<br>";
   echo $organization;
   echo "<br>";
   echo $duration;
   echo "<br>";
   echo $overview;
   echo "<br>";
   echo $skills_acquired;
   echo "<br>";
   echo $challenges;
   echo "<br>";
   echo $future_goals;
   echo "<br>";
   


}

?>
