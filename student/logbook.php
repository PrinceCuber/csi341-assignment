<?php



if ($_SERVER["REQUEST_METHOD" =="POST"]){
   $week= htmlspecialchars($_POST["week"]);
   $activities= htmlspecialchars($_POST["activities"]);
   $challenges = htmlspecialchars($_POST["challenges"]);
   $overview = htmlspecialchars($_POST["overview"]);
   $skills_acquired = htmlspecialchars($_POST["skills_acquired"]);
   $work_summary = htmlspecialchars($_POST["work-summary"]);
  
  
   echo "These are the data, that the user submitted";
   echo "<br>";
   echo $week;
   echo "<br>";
   echo $activities;
   echo "<br>";
   echo $challenges;
   echo "<br>";
   echo $overview;
   echo "<br>";
   echo $skills_acquired;
   echo "<br>";
   echo $work_summary;
   echo "<br>";
 
   


}

?>