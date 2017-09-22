
var docReady = setInterval(function () {

    if(document.readyState !== "complete"){
        return;
    }
    clearInterval(docReady);
    var contactMessages = getElementsByClassName('contact-message');
    var i;
    for(i = 0; i< contactMessages.length; i++){
        contactMessages[i].getElementsByTagName('li')[0].firstElementChild.addEventListener('click', modalOpen);
        contactMessages[i].getElementsByTagName('li')[0].firstElementChild.addEventListener('click', modalContent);
        contactMessages[i].getElementsByTagName('li')[1].firstElementChild.addEventListener('click', deleteContentMessage);

    }
    document.getElementById('modal-close').addEventListener('click',modalClose);
}, 100);
function modalContent(e){
    e.preventDefault();
    var subject = event.path[5].firstElementChild.firstElementChild.innerText;
    var sender = event.path[5].firstElementChild.lastElementChild.innerText;
    var message =  event.path[5].dataset['message'];
}






function ajax(method, url, param, callback, callbackParam) {

    var http;

    if(window.XMLHttpRequest){
        http = new XMLHttpRequest();
    }else{
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }

    http.onreadystatechange = function () {

        if(http.readyState == XMLHttpRequest.DONE){
            if(http.status == 200){

                var obj = JSON.parse(http.responseText); callback(callbackParam,true, obj);
            }else if (http.status == 400){
                alert('Category could not be saved, try again'); callback(callbackParam, false);
            }else{
                var obj = JSON.parse(http.responseText);

                if(obj.message){
                    alert(obj.message);
                } else{
                    alert('Please check name');
                }
            }
        }
    }

    http.open(method, baseUrl+url, true);
    http.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    http.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    http.send(param + "&_token=" + token);
}