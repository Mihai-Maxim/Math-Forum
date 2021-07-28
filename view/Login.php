<?php
echo '
        
        <p style="text-align:center;padding-left: 190px">Enter username and password.</p>
        <form method="POST">
         <div class="formLine">
      <label class="left">Username:</label>
      <input type="text"   class="right" placeholder="Enter Username:Max 15 chars" maxlength="15"  name="LoginRequestUsername" required />
        </div>
         <div class="formLine">
      <label class="left">Password:</label>
      <input type="password"  class="right" placeholder="Enter Password:Max 15 chars" maxlength="15" name="LoginRequestPassword" required />
        </div>
          <div class="formLine">
        <button class="PostButton" name="LoginRequest" >Login</button>
         </div>
        
        </form>
'
?>