<?php


session_start();
?>
<div ID="Chat" style="display: none; overflow-y: hidden;overflow-x: hidden ;"  >
    <div class="MessageList" id="ResizeMe" style="overflow-y: hidden;overflow-x: hidden">




        <iframe id="TV" style=" background-color: #f5f5f5; width:100%;height: 100%; border: 0px solid grey;" src="controller/chat_list_controller.php">

        </iframe>


    </div>
    <div class="MessagesAndInput">
    <div class="Messages" id="Messages" >
        <iframe style=" border-radius: 10px; background-color: #f5f5f5; width:100%;height: 100%;  transform: rotate(180deg); border: 1px solid grey;" src="view/Messages.php">

        </iframe>


    </div>
    <div ID="Input" class="Input">
        <hr style="border-radius: 15px">
        <form id="myForm" target="frame" method="POST"  enctype="multipart/form-data" >
            <textarea rows="4"  maxlength="300" cols="50" name="Message" ID="ReplyTextId" class="InputText" required></textarea>
            <button ID="InputButton"  onclick="clearReplyInput()" type="submit"  class="InputButton" name="SubmitMessage">Reply</button>
            <input type="file" ID="InputFile" accept="image/*,application/pdf,application/msword, application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint,
text/plain,application/vnd.openxmlformats-officedocument.presentationml.presentation" name="CreateChatRequestFile"  class="right adjustText"  >
        </form>
    </div>
    </div>
    <iframe style="display: none" name="frame"></iframe>
</div>
