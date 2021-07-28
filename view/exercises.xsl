<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/Exercises">

        <html>

            <head>

                <link rel="stylesheet" href="exercises.css" />
                 <script>
                     function aux() {

                     var inputs = document.getElementsByTagName('textarea');

                     for (var i = 0; i &lt; inputs.length; i++) {

                     if (inputs[i].tagName.toLowerCase() == 'textarea') {
                     autoExpand(inputs[i]);
                     }
                     }

                     }

                     var autoExpand = function (field) {
                      if(field.style.height=="30px"){
                     // Reset field height
                     field.style.height = 'inherit';

                     // Get the computed styles for the element
                     var computed = window.getComputedStyle(field);

                     // Calculate the height
                     var height = parseInt(computed.getPropertyValue('border-top-width'), 10)
                     + parseInt(computed.getPropertyValue('padding-top'), 10)
                     + field.scrollHeight
                     + parseInt(computed.getPropertyValue('padding-bottom'), 10)
                     + parseInt(computed.getPropertyValue('border-bottom-width'), 10);


                     field.style.height = height + 'px';}
                     else
                     field.style.height="30px";
                     };






                     document.addEventListener('input', function (event) {
                     if (event.target.tagName.toLowerCase() !== 'textarea') return;
                     autoExpand(event.target);
                     }, false);

                     function image(img) {

                     if(img.style.maxHeight=='100px'){
                     img.style.maxHeight="700px";
                     img.style.maxWidth="700px";}
                     else
                     {
                     img.style.maxHeight="100px";
                     img.style.maxWidth="100px";
                     }

                     }
                  function displayTable()
                     {
                       document.getElementById('ExerciseTable').style.display="none";
                       document.getElementsByClassName('frame')[0].style.display="none";
                       document.getElementsByClassName('ExerciseFrame')[0].style.display="block";
                       document.getElementsByClassName('StartNewExerciseFrame')[0].style.display="none";
                       document.getElementsByClassName('CSV')[0].style.display="none";

                     }

                 </script>


            </head>

            <body  style="margin: 0 auto;" >
           <div class="wrapper">
               <a href="../home.php" id="Home">Home</a>
               <form action="../controller/exercises_xml.php" method="GET" style="display:inline;">
                   <label for="ExerciseCategory">Category:</label>
                   <select name="ExerciseCategory" Class="ExerciseCategory">
                       <option value="All">All</option>
                       <option value="Algebra">Algebra</option>
                       <option value="Trigonometrie">Trigonometrie</option>
                       <option value="Geometrie">Geometrie</option>
                       <option value="Analiza">Analiza</option>
                   </select>
                   <label for="ExerciseByDate">Sort by:</label>
                   <select name="ExerciseByDate" Class="ExerciseByDate">
                       <option value="Newest">Newest</option>
                       <option value="Oldest">Oldest</option>
                   </select>
                   <textarea style="display:none;" name="e"></textarea>
                   <textarea  style="display:none;" name="noRedirect"></textarea>
                   <input type="submit" value="Display"></input>
                   <input type="text" name="SearchExerciseContent" style="display:inline; height:20px;" placeholder="Search:"></input>
                   <button name="SearchExercise">Search</button>
               </form>
               <script>
                   function iniFrame() {
                   if(window.self !== window.top) {

                   document.getElementById('Home').style.display="none";
                   }

                   }
                   iniFrame();
               </script>
            <table id="ExerciseTable" >

                <tr>
                    <th>Category</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Problem</th>

                </tr>
                <xsl:for-each select="Exercise">
                 <tr>
                     <td><xsl:value-of select="Category"/></td>

                     <td>
                         By:<xsl:value-of select="User"/><br></br>
                         <xsl:if test = "Image !=''">
                             <a  style="color:black; font-size:60%; padding-bottom:-10px;"><xsl:attribute name="href" >images/<xsl:value-of select="Image"/></xsl:attribute><xsl:value-of select="Image"/></a>
                             <br></br>
                         </xsl:if>
                         <xsl:value-of select="Date"/>
                     </td>

                     <td>
                         <div class="ExerciseTitle">
                             <a style="color:black;" onclick="displayTable()" target="ExerciseFrame"><xsl:attribute name="href">/~mihai.maxim/view/ExerciseView.php?te=<xsl:value-of select="Title"/></xsl:attribute>
                                 <textarea  class="ExerciseTitleTextarea" style="  text-decoration: underline; color:blue;">
                                     <xsl:value-of select="Title"/>

                                 </textarea></a>


                         </div>
                     </td>
                     <td>
                         <div class="ExerciseContent">
                             <textarea readonly="readonly" onclick="autoExpand(event.target)" name="DropDown" style="width:300px;" class="ExerciseContentTextarea">
                         <xsl:value-of select="Content"/>
                             </textarea>

                         </div>
                     </td>
                     <xsl:if test = "Image !=''">
                     <xsl:if test="Resource=-1">
                     <td style="border:0px;">

                                 <img onclick="image(this)"  style="float:right;  max-width: 100px;
    max-height: 100px; "><xsl:attribute name="src">images/<xsl:value-of select='Image' /></xsl:attribute></img>

                     </td>
                     </xsl:if>
                     </xsl:if>
                 </tr>
                </xsl:for-each>

            </table>
               <iframe  class="CSV" src="../controller/export_csv.php">

               </iframe>

                <iframe class="frame" src="Pages.php"  > </iframe>
               <iframe class="ExerciseFrame" name="ExerciseFrame" src="ExerciseView.php" frameborder="0"
                       onload="this.width=screen.width;this.height=screen.height;"    ></iframe>
               <iframe class="StartNewExerciseFrame" name="StartNewExerciseFrame" src="NewExercise.php"  ></iframe>
           </div>

            </body>



        </html>

    </xsl:template>

</xsl:stylesheet>