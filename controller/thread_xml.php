<?php
include_once('model/threadManip.php');
include_once('model/usersManip.php');
session_start();
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($_GET['LimitOn']))
{
    $_SESSION['ReplyLimit']='true';
}
if(isset($_GET['LimitOff']))
{
    $_SESSION['ReplyLimit']='false';
}
if(isset($_GET['NoReplies']))
{
    $_SESSION['ReplyLimit']='none';
}

if(isset($_GET["t"])||isset($_GET["SearchButton"])){
    header("Refresh:0");
    include_once('model/imageManip.php');
    include_once('/fenrir/studs/mihai.maxim/public_html/model/replyManip.php');
    $xml = new DOMDocument("1.0","UTF-8");
    $xml->load('view/threads.xml');
    $threads=new threadManip();
    $repliesManip=new replyManip();
    $usersMan=new usersManip();

    $stopHeading=0;
    if(empty($_GET["t"])) {
        $results = $threads->getAllThreads();
        $_SESSION['Category']='';
    }
    else
        if($_GET["t"]=="Geometrie"){
            $results=$threads->getAllThreadsGeometrie();
            $stopHeading=1;
            $_SESSION['Category']='Geometrie';}
        else
            if($_GET["t"]=="Algebra"){
                $results=$threads->getAllThreadsAlgebra();
                $stopHeading=1;
                $_SESSION['Category']='Algebra';}
            else
                if($_GET["t"]=="Trigonometrie"){
                    $results=$threads->getAllThreadsTrigonometrie();
                    $stopHeading=1;
                    $_SESSION['Category']='Trigonometrie';}
                else
                    if($_GET["t"]=="Analiza") {
                        $results = $threads->getAllThreadsAnaliza();
                        $stopHeading=1;
                        $_SESSION['Category']='Analiza';
                    }
                    else
                        if($_GET["t"]=="Newest")
                        {  if($_SESSION['Category']!='')
                        {
                            $results=$threads->getAllThreadsNewest($_SESSION['Category'],'ID');
                            usort($results, function($a, $b) {
                                return $b['ID'] - $a['ID'];
                            });
                        }
                        else
                        {
                            $results = $threads->getAllThreads();
                            usort($results, function($a, $b) {
                                return $b['ID'] - $a['ID'];
                            });
                        }
                        }
                        else
                            if($_GET["t"]=="Oldest")
                            {
                                if($_SESSION['Category']!='') {
                                    $results = $threads->getAllThreadsOldest($_SESSION['Category'], 'ID');
                                    usort($results, function($a, $b) {
                                        return $a['ID'] - $b['ID'];
                                    });

                                }
                                else
                                {
                                    $results = $threads->getAllThreads();
                                    usort($results, function($a, $b) {
                                        return $a['ID'] - $b['ID'];
                                    });


                                }

                            }
                            else
                                if($_GET["t"]=="Replies")
                                {
                                    if($_SESSION['Category']!='') {
                                        $results = $threads->getAllThreadsOldest($_SESSION['Category'], 'ID');
                                        usort($results, function($a, $b) {
                                            return $b['Relevance'] - $a['Relevance'];
                                        });
                                    }
                                    else
                                    {
                                        $results = $threads->getAllThreads();
                                        usort($results, function($a, $b) {
                                            return $b['Relevance'] - $a['Relevance'];
                                        });
                                    }

                                }

                                else
                                {
                                    $results=$threads->getThreadByTitle($_GET["t"]);
                                    $stopHeading=0;
                                    $_SESSION['ReplyLimit']='false';
                                    $_SESSION['Category']='';
                                    $threadId=$threads->getThreadByTitle($_GET["t"]);
                                    $replyCount=$repliesManip->getRepliesByThreadId($threadId[0]['ID']);

                                    $_SESSION['NewRepliesCount']=$replyCount[0][0];

                                    if(!isset($_GET['isReply']))
                                        $_SESSION['NewReplies']=$_GET["t"];




                                }

    if(isset($_GET["SearchButton"])){
        if(!empty($_GET["SearchMessage"]))
        {
            $msg= '%'.str_replace(' ','%',$_GET['SearchMessage']).'%';
            $results=$threads->getThreadsByList($msg);
            if(empty($results))
            {
                ?>
                <script type="text/javascript">
                    alert('Input not found!')
                </script>
                <?php

            }
            $stopHeading=1;
        }
        else{
            ?>
            <script type="text/javascript">
                alert('No input to search!')
            </script>
            <?php
            $stopHeading=1;
        }

    }




    $elements = $xml->getElementsByTagName('Thread');
    for ($i = $elements->length; --$i >= 0; ) {
        $href = $elements->item($i);
        $href->parentNode->removeChild($href);
    }

    $images=new imageManip();

    foreach($results as $row) {

        $rootTag=$xml->getElementsByTagName('Threads')->item(0);
        $user=$xml->createElement('User');
        $text=$xml->createTextNode($row['Username']);
        $user->appendChild($text);
        $title=$xml->createElement('Title',$row['Title']);
        $category=$xml->createElement('Category',$row['Category']);
        $content=$xml->createElement('Content',$row['Content']);
        $date=$xml->createElement('Date',$row['updated_at']);
        $idtag=$xml->createElement('Id',$row['ID']);




        $id=$row['ID'];
        $id=$images->getThreadImageFromId($id);
        if($id===0)
            $image=$xml->createElement('Image','');
        else
            $image=$xml->createElement('Image',$id[0]['IMG_NAME']);

        $filext=explode('.',$id[0]['IMG_NAME']);
        $filextlow=strtolower(end($filext));
        $allowed=array('jpg','jpeg','png','svg');
        if(in_array($filextlow,$allowed))
        {
            $resource=$xml->createElement('Resource',-1);

        }else
            $resource=$xml->createElement('Resource',1);



        $thread=$xml->createElement("Thread");

        $thread->appendChild($user);
        $thread->appendChild($title);
        $thread->appendChild($category);
        $thread->appendChild($content);
        $thread->appendChild($image);
        $thread->appendChild($date);
        $thread->appendChild($idtag);
        $thread->appendChild($resource);
        if((strcmp($row['Username'],$_SESSION['Username'])==0)||(isset($_SESSION['IsAdmin'])))
        {
            $threadAdmin=$xml->createElement('ThreadAdmin',$row['ID']);
        }
        else
            $threadAdmin=$xml->createElement('ThreadAdmin',-1);
        $thread->appendChild($threadAdmin);
        $replies=$repliesManip->getAllReplies();
        if(count($replies)==0)
            $rootTag->appendChild($thread);
        $count=0;
        if($_SESSION['ReplyLimit']=='none')
        {
            $limit=0;
        }else
            $limit=3;

        foreach ($replies as $reply)
        {
            if($reply['THREAD_ID']==$row[ID]){

                $Reply = $xml->createElement("Reply");
                $ReplyContent = $xml->createElement('ReplyContent', $reply['CONTENT']);
                $ReplyDate = $xml->createElement('ReplyDate', $reply['UPDATED_AT']);
                $ReplyImage = $xml->createElement('ReplyImage', $reply['IMAGE_NAME']);
                $user = $usersMan->getUserById($reply['USER_ID']);
                if(!empty($user))
                    $ReplyUsername = $xml->createElement('ReplyUsername', $user[0]);
                else
                    $ReplyUsername = $xml->createElement('ReplyUsername', $reply['Anon']);

                $filext=explode('.',$reply['IMAGE_NAME']);
                $filextlow=strtolower(end($filext));
                $allowed=array('jpg','jpeg','png','svg');
                if(in_array($filextlow,$allowed))
                {
                    $resource=$xml->createElement('ReplyResource',-1);

                }else
                    $resource=$xml->createElement('ReplyResource',1);


                $Reply->appendChild($ReplyUsername);
                $Reply->appendChild($ReplyContent);
                $Reply->appendChild($ReplyDate);
                $Reply->appendChild($ReplyImage);
                $Reply->appendChild($resource);
                if(((strcmp($user[0],$_SESSION['Username'])==0)&&isset($_SESSION['Username']))||(isset($_SESSION['IsAdmin'])))
                {
                    $replyAdmin=$xml->createElement('ReplyAdmin',$reply['REPLY_NUMBER']);
                }
                else
                    $replyAdmin=$xml->createElement('ReplyAdmin',-1);
                $Reply->appendChild($replyAdmin);


                if(($_SESSION['ReplyLimit']=='true'&&$count<$limit)||($_SESSION['ReplyLimit']=='false'))
                {
                    $count=$count+1;
                    $thread->appendChild($Reply);
                }


            }
            else
                $rootTag->appendChild($thread);
        }






        $xml->save('view/threads.xml');
    }
    clearstatcache();
//*

    if($stopHeading==0)
        header("Location: view/threads.xml");
    else
        if($stopHeading==1)
        {  ?>
            <script type="text/javascript">
                location="home.php";
            </script>
            <?php
        }

//*/


}

?>