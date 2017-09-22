function modalOpen(e) {
    e.preventDefault();
    var background = document.createElement('div');
    background.className = 'modal-background';
    var width = window.innerWidth;
    var height = window.innerHeight;
    background.style.width  = width;
    background.style.height = height;
    document.appendChild(background);
    var modal = getElementsByClassName('modal')[0];
    modal.style.display = "block";
    //setting timeout fot the animation
    setTimeout(function(){
        modal.style.top = height/2 - modal.offsetHeight/2 + "px";
    },10)
}

function modalClose(e){
    e.preventDefault();
    var modal = getElementsByClassName('modal')[0];
    while(modal.firstElementChild.tagName !== 'button'){
        modal.firstElementChild.remove();
    }
    modal.style.top = "10%";
    modal.style.display = "none";
    var background = getElementsByClassName('modal-background')[0];
    background.remove();
}
