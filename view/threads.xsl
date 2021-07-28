<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/Threads">

        <html>

            <head>
                <link rel="stylesheet" href="threads.css" />

            </head>

            <body onload="aux()">



                <UL>

                    <li ID="Home"><a href="../home.php" >Home</a></li>
                    <li><a href="../home.php?t=" >See all threads</a></li>
                    <li>
                        Sort by:
                    </li>
                    <li><a href="../home.php?t=Newest" >Newest</a></li>
                    <li><a href="../home.php?t=Oldest" >Oldest</a></li>

                    <li><a href="../home.php?t=Replies" >Most replies</a></li>
                    <li><a href="../home.php?LimitOn=true&amp;t=">Only 3 replies</a></li>
                    <li><a href="../home.php?LimitOff=true&amp;t=">All replies</a></li>
                    <li><a href="../home.php?NoReplies=true&amp;t=">No replies</a></li>
                </UL>
                <script>
                    function iniFrame() {
                    if(window.self !== window.top) {

                    document.getElementById('Home').style.display="none";
                    }

                    }
                    iniFrame();


                    function aux() {

                    var inputs = document.getElementsByTagName('textarea');

                    for (var i = 0; i &lt; inputs.length; i++) {

                    if (inputs[i].tagName.toLowerCase() == 'textarea') {
                    autoExpand(inputs[i]);
                    }
                    }

                    }





                </script>



                <xsl:for-each select="Thread">

                    <div class="blended_grid">

                        <div class="Left">
                            <xsl:if test = "Image !=''">
                                <xsl:if test="Resource=-1">
                                    <img  onclick="image(this)" style="float:right;"><xsl:attribute name="src">images/<xsl:value-of select='Image' /></xsl:attribute></img>
                                </xsl:if>
                            </xsl:if>
                        </div>
                        <div class="Top1">
                            <texarea  class="TitleText">
                                By:<xsl:value-of select="User"/><br></br>
                                In:<xsl:value-of select="Category"/><br></br>
                                <xsl:value-of select="Date"/><br></br>

                                <xsl:if test = "Image !=''">
                                    <a  style="color:black; font-size:70%; "><xsl:attribute name="href" >images/<xsl:value-of select="Image"/></xsl:attribute><xsl:value-of select="Image"/></a>

                                </xsl:if>
                            </texarea>

                        </div>

                        <div class="Top2">
                            <a style="color:black;"><xsl:attribute name="href">/~mihai.maxim/home.php?t=<xsl:value-of select="Title"/></xsl:attribute>
                                <h3 style="opacity:80%;"><xsl:value-of select="Title"/>  <xsl:if test = "ThreadAdmin > 0"><form action="../controller/delete_thread_controller.php"> <button style ="border:1px black solid;color: black;" type ="submit"  name="DeleteThread" class="Button"><xsl:attribute name="value"><xsl:value-of select="Id" /></xsl:attribute><center>Delete</center></button> </form></xsl:if> </h3>
                            </a>
                        </div>
                        <div class="Mid">
                            <xsl:choose>
                                <xsl:when test="ThreadAdmin > 0">

                                    <form action="../controller/update_thread_controller.php">
                                        <textarea  id="PostContent" name="PostText" maxlength="5000" class="ReplyForm Text2" style="margin: 0px; width: 600px; resize: none; border:2px solid black;  background-color: #f5f5f5;border-radius:20px; " >  <xsl:value-of select="Content"/></textarea>
                                        <button style ="border:1px black solid;color: black;" type ="submit" name="UpdateThread"  class="Button"><xsl:attribute name="value"><xsl:value-of select='Id' /></xsl:attribute><center>Update </center></button>
                                    </form>
                                </xsl:when>
                                <xsl:when test="ThreadAdmin  =-1 ">
                                    <textarea readonly="readonly" id="PostContent" name="PostText" maxlength="5000" class="ReplyForm Text2" style="margin: 0px; width: 600px;resize: none; border:2px solid black;background-color: #f5f5f5; border-radius:20px;" >  <xsl:value-of select="Content"/></textarea>
                                </xsl:when>
                            </xsl:choose>

                        </div>
                        <xsl:if test = "ThreadAdmin > 0">

                        </xsl:if>

                        <xsl:for-each select="Reply">

                            <div class="blended_grid2">
                                <div  class="ReplyTop"  >

                                    <form action="../controller/manage_reply_controller.php" method="POST">
                                        <xsl:choose>
                                            <xsl:when test="ReplyAdmin > 0">
                                                <textarea Class="Text ReplyText" name="ReplyRequestText" maxlength="2000"   ><xsl:value-of select="ReplyContent"/></textarea>
                                            </xsl:when>
                                            <xsl:when test="ReplyAdmin = -1">
                                                <textarea class="Text ReplyText" readonly="readonly" name="ReplyRequestText" maxlength="2000"   ><xsl:value-of select="ReplyContent"/></textarea>
                                            </xsl:when>
                                        </xsl:choose>
                                        <xsl:if test = "ReplyAdmin > 0">
                                            <button style ="border:1px black solid;color: black;" type ="submit" name="UpdateReply"  class="Button"><xsl:attribute name="value"><xsl:value-of select='ReplyAdmin' /></xsl:attribute>Update</button>
                                                <button style ="border:1px black solid;color: black;" type ="submit" name="DeleteReply"  class="Button"><xsl:attribute name="value"><xsl:value-of select='ReplyAdmin' /></xsl:attribute>Delete</button>

                                        </xsl:if>

                                    </form>
                                </div>
                                <div class="ReplyRight1">

                                    By:<xsl:value-of select="ReplyUsername"/><br></br>
                                    <xsl:value-of select="ReplyDate"/><br></br>
                                    <xsl:if test = "ReplyImage !=''">
                                        <a style="color:black; font-size:70%; "><xsl:attribute name="href">images/<xsl:value-of select="ReplyImage"/></xsl:attribute><xsl:value-of select='ReplyImage' /></a>
                                    </xsl:if>

                                </div>
                                <div class="ReplyRight2">
                                    <xsl:if test = "ReplyImage !=''">
                                        <xsl:if test="ReplyResource =-1">
                                            <img onclick="imageReply(this)" style="max-width:60px;
                   max-height: 80px;padding-top:5px; padding-bottom:15px;"><xsl:attribute name="src" >images/<xsl:value-of select='ReplyImage' /></xsl:attribute></img>
                                        </xsl:if>
                                    </xsl:if>
                                </div>
                            </div>


                        </xsl:for-each>


                        <div class="Reply">
                            <form method="POST" enctype="multipart/form-data" action="../controller/reply_controller.php"  >
                                <textarea  name="CreateReplyRequestText" rows="5" maxlength="5000" cols="50"  style="border:solid 1px black; border-radius:20px;padding:10px;" ></textarea>
                                <input type="file" accept="image/*,application/pdf,application/msword, application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint,
text/plain,application/vnd.openxmlformats-officedocument.presentationml.presentation" name="CreateReplyRequestFile"  class="right adjustText"/>
                                <button type ="submit" name="CreateReplySubmit" class="RegularButton"><xsl:attribute name="value"><xsl:value-of select='Id' /></xsl:attribute><center>Reply </center></button>

                            </form>
                        </div>
                    </div>

                </xsl:for-each>

            </body>

            <script type="text/javascript" src="../controller/XmlScript.js">&#160;</script>

        </html>

    </xsl:template>

</xsl:stylesheet>