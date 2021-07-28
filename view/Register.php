<?php

echo ' 
  
        <div class="registerStyle">
          <p style="text-align:center;padding-left: 215px">Fill in this form to create an account.</p>
        <form method="POST">
            <div class="formLine">
           <label class="left">Email:</label>
            <input type="text"  name="RegisterRequestEmail" class="right" placeholder="Enter Email" required />
        </div>
        <div class="formLine">
           <label class="left">Username:</label>
            <input type="text"  name="RegisterRequestUsername" class="right" placeholder="Enter Username:Max 15 chars" maxlength="15"  required />
        </div>
        <div class="formLine">
           <label class="left">Password:</label>
            <input type="password"  name="RegisterRequestPassword" class="right" placeholder="Enter Password:Max 15 chars" maxlength="15"  required />
        </div>
         <div class="formLine">
        <button class="PostButton" name="RegisterRequest" >Register</button>
         </div>
        </form>
       </div>

 ';