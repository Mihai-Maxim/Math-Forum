<?php
echo ' <form method="POST" enctype="multipart/form-data">
       <div class="formLine">
           <label class="left">Categorie:</label>
            <select name="CreateThreadRequestCategory" class="right Categorii">
                <option value="Geometrie">Geometrie</option>
                <option value="Algebra">Algebra</option>
                <option value="Analiza">Analiza</option>
                <option value="Trigonometrie">Trigonometrie</option>
            </select>
        </div>
       <div class="formLine">
           <label class="left">Titlu:</label>
            <input type="text"  name="CreateThreadRequestTitle" class="right" maxlength="80" placeholder="Max length:80 characters" required />
        </div>
        <div class="formLine">
           <label  class="left">Content:</label>
           <textarea name="CreateThreadRequestComments" rows="10"  maxlength="5000" cols="50" class="right resize" placeholder="Max length:5000 characters" required></textarea>
        </div>
        <div class="formLine">
       <label  class="left">Ataseaza fisier:</label>
       <input type="file" accept="image/*,application/pdf,application/msword, application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint,
text/plain,application/vnd.openxmlformats-officedocument.presentationml.presentation" name="CreateThreadRequestFile" class="right adjustText"  >
        </div>
        <div class="formLine" >
         <label  class="left checkboxLabel">Posteaza ca anonim:</label>
         <input type="checkbox" name="CreateThreadRequestAnon"  class="right checkbox">
        </div>
        <div class="formLine">
        <button class="PostButton" name="CreateThreadSubmit" value="ThreadSubmited" >Start new thread</button>
        </div>
    </form>';
