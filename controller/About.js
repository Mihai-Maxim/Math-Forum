function displayAbout(id) {
    let el = document.getElementById(id);
    let divs = document.getElementsByClassName('About');
    for(let i=0;i<divs.length;i++){
        if(divs[i] == el){
            if(divs[i].style.display!="block")
            divs[i].style.display="block";
            else
                divs[i].style.display="none";
        }
        else{
            divs[i].style.display="none";
        }
    }

}