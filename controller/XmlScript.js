var autoExpand = function (field) {

    field.style.height = 'inherit';


    var computed = window.getComputedStyle(field);

    var height = parseInt(computed.getPropertyValue('border-top-width'), 10)
        + parseInt(computed.getPropertyValue('padding-top'), 10)
        + field.scrollHeight
        + parseInt(computed.getPropertyValue('padding-bottom'), 10)
        + parseInt(computed.getPropertyValue('border-bottom-width'), 10);

    field.style.height = height + 'px';

};

document.addEventListener('input', function (event) {
    if (event.target.tagName.toLowerCase() !== 'textarea') return;
    autoExpand(event.target);
}, false);





function aux() {

    var inputs = document.getElementsByTagName('textarea');

    for (var i = 0; i< inputs.length; i++) {

        if (inputs[i].tagName.toLowerCase() == 'textarea') {
            autoExpand(inputs[i]);
        }
    }

}


function image(img) {

    if(img.style.maxHeight=='200px'){
        img.style.maxHeight="700px";
        img.style.maxWidth="700px";}
    else
    {
        img.style.maxHeight="200px";
        img.style.maxWidth="150px";
    }

}
function imageReply(img) {

    if(img.style.maxHeight=='80px'){
        img.style.maxHeight="700px";
        img.style.maxWidth="680px";}
    else
    {
        img.style.maxHeight="80px";
        img.style.maxWidth="60px";
    }

}

