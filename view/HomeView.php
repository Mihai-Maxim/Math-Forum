<article resource="#" typeof="schema:ScholarlyArticle">
    <header>
        <h1  style="font-family :Comic Sans MS;opacity:65%; color:black;" property="schema:name">Final Project</h1>
        <h3 style="font-family :Comic Sans MS;opacity:65%; color:black;" role="doc-subtitle" property="schema:alternateName">
            A proof of our understanding of the concepts taught throughout this Course.
        </h3>
        <a href="Scholarly.html" target="_parent">Scholarly Html Documentation</a>
        <title>Documentation</title>
    </header>
    <meta property="schema:accessibilityFeature" content="alternativeText">
    <meta property="schema:accessibilityFeature" content="MathML">
    <meta property="schema:accessibilityHazard" content="noFlashingHazard">




<?php
session_start();
echo '<link rel="stylesheet" type="text/css" href="Style.css">';
echo '<h3 style="text-align: center; font-family :Comic Sans MS;opacity:65%; color:black; padding-top: 3%;">Wellcome to the Math Equation Web Explorer.</h3>';
echo '<h3  style="text-align: center; font-family :Comic Sans MS;opacity:65%; color:black;">This website was created as an assignment for our Web-Development Course at the "Alexandru Ioan Cuza" University, Faculty of Computer Science.</h3>';
echo '<h3  style="text-align: center; font-family :Comic Sans MS;opacity:65%; color:black;">The purpose of this platform is to serve as an environment where users can discuss/compare/share mathematical equations/problems.</h3>';
echo '<h3  style="text-align: center; font-family :Comic Sans MS;opacity:65%; color:black;">To accomplish this goal,our website offers the following Features: </h3>';
echo '<h3 onclick="displayAbout('.'&apos;'.'LogAbout'.'&apos;'.')" style="text-align: center; font-family :Comic Sans MS;opacity:65%; color:black;  color:blue;text-decoration:underline;">A responsive Activity Log + Admin Tools</h3>';
echo '<h3 onclick="displayAbout('.'&apos;'.'DiscussionsAbout'.'&apos;'.')" style="text-align: center; font-family :Comic Sans MS;opacity:65%; color:black;  color:blue;text-decoration:underline;">A general discussion section</h3>';
echo '<h3 onclick="displayAbout('.'&apos;'.'ExercisesAbout'.'&apos;'.')" style="text-align: center; font-family :Comic Sans MS;opacity:65%; color:black; color:blue;text-decoration:underline;">An exercise section</h3>';
echo '<h3 onclick="displayAbout('.'&apos;'.'ChatAbout'.'&apos;'.')"  style="text-align: center; font-family :Comic Sans MS;opacity:65%; color:black; color:blue;text-decoration:underline;">A chat</h3>';

echo '
  <div class="About" id="DiscussionsAbout" >
  
  <p><strong>This section is destined for general questions/discussions.</strong></p>
  <p><strong>One can start a discussion by creating a "thread".</strong></p>
  <p><strong>The requirements are: selecting a category,a title and a description of the topic.</strong></p>
  <p><strong>In addition,the users can post a picture/document/text-file alongside the thread.</strong></p>
  <p><strong>You can post as anonymous! (if you select the option or if you are not logged-in)</strong></p>
  <p><strong>The downside is that,in this case, you cannot administer your post,i.e: update/delete .</strong></p>
  <p><strong>Other users (logged-in or not) can reply with messages/images/documents.</strong></p>
  <p><strong>If the user is logged,he can administer his replies too!</strong></p>
  <p><strong>By clicking on the title of a thread,you are automatically subscribed to its changes.</strong></p>
  <p><strong>Meaning that you will be notified when other users interact with it.</strong></p>
  <p><strong>All the images in this section resize when clicked on.</strong></p>
  </div>
  
  <div class="About" id="ExercisesAbout">
   <p><strong>This section is destined to hold a library of practical exercises.</strong></p>
   <p><strong>You must be logged-in to be able to contribute to the repository.</strong></p>
   <p><strong>The source of the exercise can be a image/document or simply text.</strong></p>
   <p><strong>This section also supports the update/delete/reply trio.</strong></p>
   <p><strong>In addition,exercises can be imported to the website or exported,using the CSV format. </strong></p>
   <p><strong>To read the full text of a problem(in the table view) you can double-click on the area you want to expand.</strong></p>
   <p><strong>To write equations,we suggest using the open source CodeCogs EquationEditor</strong></p>
   <p><strong>All the images resize when clicked on.</strong></p>
  </div>
  
  <div class="About" id="ChatAbout">

   <p><strong>The chat enables different users to discuss topics in greater detail.</strong></p>
   <p><strong>The main channel, the "AllChat" ,is open for all types of users(logged-in or not).</strong></p>
   <p><strong>The message feed is responsive to change,displays updates when they take place!</strong></p>
   <p><strong>Talking to a specific individual(private messaging) is supported by a "contacts" system:</strong></p>
   <p><strong>Adding a new contact happens in real time,meaning that both parties will be notified!</strong></p>
   <p><strong>The user can switch between the contacts they are currently talking to.</strong></p>
   <p><strong>In addition,the chat supports sending images/documents alongside text!</strong></p>

</div>

<div class="About" id="LogAbout">
<p><strong>The Activity Log keeps the users engaged with the ongoing activities!</strong></p>
<p><strong>Due to it being responsive,the users are informed about the latest updates as soon as they occur.</strong></p>
<p><strong>For the admins,managing the stream of activities is pretty simple:</strong></p>
<p><strong>You have read+write rights to every type of entity present on the platform(excluding the private messages).</strong></p>
<p><strong>You can block users from posting or delete public chat messages that seem unfit.</strong></p>

</div>


';
?>
<script src="../controller/About.js">

</script>


</article>



