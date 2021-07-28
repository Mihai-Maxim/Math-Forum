<?php
session_start();
include_once("../controller/insert_exercise.php");
include_once('../controller/insert_image_exercise.php');
if(isset($_SESSION['Username'])) {
    echo ' <form method="POST" enctype="multipart/form-data">
       <div class="formLine">
           <label for="Categorii" class="left">Categorie:</label>
            <select name="CreateExerciseRequestCategory" class="right Categorii">
                <option value="Geometrie">Geometrie</option>
                <option value="Algebra">Algebra</option>
                <option value="Analiza">Analiza</option>
                <option value="Trigonometrie">Trigonometrie</option>
            </select>
        </div>
       <div class="formLine">
           <label class="left">Titlu:</label>
            <input type="text"  name="CreateExerciseRequestTitle" class="right" max="80" placeholder="Max length:80 characters" required />
        </div>
        <div class="formLine">
           <label for="comments"class="left">Content:</label>
           <textarea name="CreateExerciseRequestComments" rows="10"  maxlength="5000" cols="50" class="right resize" placeholder="Max length:5000 characters" required></textarea>
        </div>
        <div class="formLine">
       <label for="fileInput" class="left">Ataseaza fisier:</label>
       <input type="file" accept="image/*,application/pdf,application/msword, application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint,
text/plain,application/vnd.openxmlformats-officedocument.presentationml.presentation" name="CreateExerciseRequestFile" value="set" class="right adjustText"  >
        </div>
       
        <div class="formLine">
        <button class="PostButton" name="CreateExerciseSubmit" value="ExerciseSubmited" ><center>Post Exercise</center></button>
        </div>
    </form>';
}
else
    echo '<p style="font-family: Comic Sans MS;opacity: 65%;"><strong>You must be signed in to post!</strong></p>';

