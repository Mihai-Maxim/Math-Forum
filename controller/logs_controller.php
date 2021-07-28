<?php
require_once('/fenrir/studs/mihai.maxim/html/model/logsManip.php');
include_once ('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
include_once ('/fenrir/studs/mihai.maxim/html/model/exerciseManip.php');
session_start();
if(isset($_GET['GetLogs'])) {
    $logs = new logsManip();
    $threads=new threadManip();
    $exercises=new exerciseManip();
    $logs = $logs->getLogs();
    foreach ($logs as $log) {
        $thread=$threads->getThreadByTitle($log['Title']);
        $exercise=$exercises->getExerciseByTitle($log['Title']);
        if((!empty($thread))||(!empty($exercise)))
            $exists=1;
        else $exists=0;
        $time=explode(" ",$log['updated_at']);
        if($log['Category']==1){
            if($exists==1) {
                echo '<p>' . $log['Frm'] . ' created a new thread: ' . "<a target='_top' href='../home.php?t=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
            }}
        else
            if($log['Category']==2){
                if($exists==1) {
                    echo '<p>' . $log['Frm'] . ' posted a new reply in ' . "<a target='_top' href='../home.php?t=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                }}
            else
                if($log['Category']==3) {
                    echo '<p>' . $log['Frm'] . ' deleted a thread:  ' . $log['Title'] . '<br>' . $log['updated_at'] . '</p>';
                }
                else
                    if($log['Category']==4){
                        if($exists==1) {
                            echo '<p>' . $log['Frm'] . ' updated a thread :' . "<a target='_top' href='../home.php?t=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                        }}
                    else
                        if($log['Category']==5){
                            if($exists==1) {
                                echo '<p>' . $log['Frm'] . ' deleted a reply in ' . "<a target='_top' href='../home.php?t=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                            }}
                        else
                            if($log['Category']==6){
                                if($exists==1) {
                                    echo '<p>' . $log['Frm'] . ' updated a reply in ' . "<a target='_top' href='../home.php?t=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                                }}
                            else
                                if($log['Category']==7){
                                    if($exists==1) {
                                        echo '<p>' . $log['Frm'] . ' created a new exercise:' . "<a target='_top' href='../view/ExerciseView.php?te=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                                    }}
                                else
                                    if($log['Category']==8){
                                        if($exists==1) {
                                            echo '<p>' . $log['Frm'] . ' updated an exercise: ' . "<a target='_top' href='../view/ExerciseView.php?te=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                                        }}
                                    else
                                        if($log['Category']==9) {
                                            echo '<p>' . $log['Frm'] . ' deleted an exercise:  ' . $log['Title'] . '<br>' . $log['updated_at'] . '</p>';
                                        }
                                        else
                                            if($log['Category']==10){
                                                if($exists==1) {
                                                    echo '<p>' . $log['Frm'] . ' replied to an exercise in: ' . "<a target='_top' href='../view/ExerciseView.php?te=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                                                }}
                                            else
                                                if($log['Category']==11){
                                                    if($exists==1) {
                                                        echo '<p>' . $log['Frm'] . ' updated a reply to an exercise in: ' . "<a target='_top' href='../view/ExerciseView.php?te=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                                                    }}
                                                else
                                                    if($log['Category']==12){
                                                        if($exists==1) {
                                                            echo '<p>' . $log['Frm'] . ' deleted a reply to an exercise in: ' . "<a target='_top' href='../view/ExerciseView.php?te=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                                                        }}


    }
}