
 var docReady = setInterval(function () {

     if(document.readyState !== "complete"){
         return;
     }
     clearInterval(docReady);

     //Edit event handler

     var editSection = document.getElementsByClassName('edit');
     var i;
     for(i=0; i<editSection.length; i++){
        editSection[i].firstElementChild.firstElementChild.children[1].firstElementChild.addEventListener('click', startEdit);
         editSection[i].firstElementChild.firstElementChild.children[2].firstElementChild.addEventListener('click', startDelete);
     }

    //create new category event handler

     document.getElementsByClassName('btn')[0].addEventListener('click', createNewCategory);

 }, 100);

    // edit function construction
 function startEdit(event){
     event.preventDefault();
     event.target.innerText = "save";
     var li = event.path[2].children[0];
     li.children[0].value = event.path[4].previousElementSibling.children[0].innerText;
     li.style.display = 'inline-block';
     setTimeout(function(){
         li.children[0].style.maxWidth = '110px';
     }, 1);
     event.target.removeEventListener('click', startEdit);
     event.target.addEventListener('click', saveEdit);
 }

 function saveEdit(e){
     e.preventDefault(); var li = event.path[2].children[0];
     var categoryName = li.children[0].value;
     var categoryId = event.path[4].previousElementSibling.dataset['id'];

     if(categoryName.length == 0){
         alert('Please enter a valid category nane');return;
     }
    ajax("POST", "/admin/blog/categories/update", "name=" + categoryName + "&category_id=" + categoryId, endEdit, [event]);
 }

 function endEdit(param, success, responseObj){
     var event = param[0];
     if(success){
         var newName = responseObj.new_name;
         var article = event.path[5];
         article.style.backgroundColor = "#afefac";

         setTimeout(function(){
             article.style.backgroundColor = "white";
         }, 300);

         article.firstElementChild.firstElementChild.innerHTML = newName;
     }

     event.target.innerText = "Edit";
     var li = event.path[2].children[0];
     li.children[0].style.maxWidth = "0";

     setTimeout(function(){
         li.style.display = "none";
     },310);

     event.target.removeEventListener('click', saveEdit);
     event.target.addEventListener('click', startEdit);
 }
 //
 function startDelete(event){
        deleteCategory(event);
 }

 function deleteCategory(e){
     event.preventDefault();
     event.target.removeEventListener('click',startDelete);

     var CategoryId = e.path[4].previousElementSibling.dataset['id'];
     ajax("GET", "admin/blog/category/"+ CategoryId + "/delete",null,categoryDeleted,[event.path[5]]);
 }
 function categoryDeleted(param, success,responseObj){
        var article = param[0];
            if(success){
                article.style.backgroundColor = "#ffc4be";
                setTimeout(function(){
                    article.remove();
                    location.reload();
                },300);
            }
 }
 function createNewCategory(event){
     event.preventDefault();

     var name = event.target.previousElementSibling.value;
        if(name.length == 0){
            alert('Please enter a valid category name');
            return;
        }
     ajax("POST","/admin/blog/category/create", "name=" + name, newCategoryCreated, [name]);
 }


 function newCategoryCreated(param, success,responseObj){
     location.reload();
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