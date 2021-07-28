

function display(id){
    let el = document.getElementById(id);
    let divs = document.getElementsByClassName('Container');
    for(let i=0;i<divs.length;i++){
        if(divs[i] == el){
            divs[i].style.display="block";
        }
        else{
            divs[i].style.display="none";
            document.getElementById('Frame').style.display="none";
        }
    }
    document.getElementById('Chat').style.display="none";
    document.getElementById('Frame2').style.display="none"
    document.getElementById('HomeFrame').style.display="none";

}
function displayHomeFrame() {
    let divs = document.getElementsByClassName('Container');
    for(let i=0;i<divs.length;i++){

        divs[i].style.display="none";
    }
    document.getElementById('Chat').style.display="none";
    document.getElementById('Frame2').style.display="none";
    document.getElementById('Frame').style.display="none";
    document.getElementById('HomeFrame').style.display="inline-block";

}
function displayThreads()
{
    document.getElementById('ThreadPress').click();
}

function displayExercises()
{
    document.getElementById('ExercisePress').click();
}
function displayThreadsGeometrie()
{

    document.getElementById('ThreadPress').value="Geometrie";
    document.getElementById('ThreadPress').click();
}
function displayThreadsAlgebra()
{
    document.getElementById('ThreadPress').value="Algebra";
    document.getElementById('ThreadPress').click();
}
function displayThreadsTrigonometrie()
{
    document.getElementById('ThreadPress').value="Trigonometrie";
    document.getElementById('ThreadPress').click();
}
function displayThreadsAnaliza()
{
    document.getElementById('ThreadPress').value="Analiza";
    document.getElementById('ThreadPress').click();
}
function displayFrame()
{
    let divs = document.getElementsByClassName('Container');
    for(let i=0;i<divs.length;i++){

        divs[i].style.display="none";
    }

    if(document.getElementById('Frame').style.display!="inline-block")
        document.getElementById('Frame').style.display="inline-block";
    document.getElementById('Chat').style.display="none";
    document.getElementById('Frame2').style.display="none";
    document.getElementById('HomeFrame').style.display="none";
}
function displayFrameExercise()
{
    let divs = document.getElementsByClassName('Container');
    for(let i=0;i<divs.length;i++){

        divs[i].style.display="none";
    }
    document.getElementById('Chat').style.display="none";
    document.getElementById('Frame').style.display="none";
    document.getElementById('HomeFrame').style.display="none";

    if(document.getElementById('Frame2').style.display!="inline-block")
        document.getElementById('Frame2').style.display="inline-block";


}
function displayChat() {
    let divs = document.getElementsByClassName('Container');
    for(let i=0;i<divs.length;i++){

        divs[i].style.display="none";
    }
    document.getElementById('HomeFrame').style.display="none";
    document.getElementById('Frame').style.display="none";
    document.getElementById('Chat').style.display="block";
    document.getElementById('Frame2').style.display="none";

}
async function clearReplyInput() {
    await new Promise(r => setTimeout(r, 250));
    document.getElementById('ReplyTextId').value="";
    document.getElementById('InputFile').value=null;

}
function disableUnderline()
{
    let divs = document.getElementsByClassName('Shortcut');
    for(let i=0;i<divs.length;i++){

        divs[i].style.textDecoration="none";
    }
}
function displayActiviyLog()
{
    if (document.getElementById('Activitylog').style.display=="block")
    {document.getElementById('Activitylog').style.display="none";
    }
    else
    { document.getElementById('Activitylog').style.display="block";}
}
window.addEventListener('resize', function(event){
    var body = document.body,
        html = document.documentElement;

    var height = Math.max( html.clientHeight);

    document.getElementById('Frame').style.height=String(height-150)+"px";
    document.getElementById('Frame2').style.height=String(height-150)+"px";
    document.getElementById('LeftSide').style.height=String(height+document.getElementById('Header').style.height-100)+"px";
   document.getElementById('rightBanner').style.height=String(height-110)+"px";

         document.getElementById('rightBanner').style.width='20%';

        document.getElementById('Messages').style.height=String(height-275)+"px";



});
var body = document.body,
    html = document.documentElement;

var height = Math.max( html.clientHeight);

document.getElementById('Frame').style.height=String(height-150)+"px";
document.getElementById('Frame2').style.height=String(height-150)+"px";
document.getElementById('LeftSide').style.height=String(height+document.getElementById('Header').style.height-100)+"px";
document.getElementById('rightBanner').style.height=String(height-110)+"px";



    document.getElementById('Messages').style.height=String(height-275)+"px";
    document.getElementById('ResizeMe').style.height=String(height-275)+"px";




document.getElementById('rightBanner').style.width='20%';


var input = document.getElementById("Input");




window.setInterval(showUpdate, 1000);

function showUpdate() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("Notification").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "controller/reply_detection.php", true);
    xmlhttp.send();


}



