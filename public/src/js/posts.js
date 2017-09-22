 var addedCategoryText;
 var addedCategoryIDs;
    var i = 0;
 var docReady = setInterval(function () {

     if(document.readyState !== "complete"){
         return;
     }
     clearInterval(docReady);

     //Edit event handler
        var addCategoryBtn = document.getElementById('btn');
        addedCategoryIDs = document.getElementById('categories');
        addCategoryBtn.addEventListener('click', addCategoryToPost);
        addedCategoryText = document.getElementsByClassName('added-categories')[0];

     for(i = 0 ; i< addedCategoryText.firstElementChild.children.length; i++){

         addedCategoryText.firstElementChild.children[i].firstElementChild.addEventListener('click', removeCategoryFromPost);
     }
 }, 100);

 function addCategoryToPost(event){
     event.preventDefault();
     var select = document.getElementById('category_select');
     var selectedCategoryID = select.options[select.selectedIndex].value;
     var selectedCategoryName = select.options[select.selectedIndex].text;

     if(addedCategoryIDs.value.split(",").indexOf(selectedCategoryID) != -1){
         return;
     }
     if(addedCategoryIDs.value.length > 0){
         addedCategoryIDs.value = addedCategoryIDs.value +","+ selectedCategoryID;
     }else{
         addedCategoryIDs.value = selectedCategoryID;
     }

     var newCategoryLi = document.createElement('li');
            newCategoryLi.style.display="inline-block";
            newCategoryLi.style.marginRight="5px";
     var newCategorylink = document.createElement('a');
        newCategorylink.href = "#";
        newCategorylink.innerText = selectedCategoryName;
        newCategorylink.dataset['category_id'] = selectedCategoryID;
        newCategorylink.addEventListener('click', removeCategoryFromPost);
        newCategoryLi.appendChild(newCategorylink);

     addedCategoryText.firstElementChild.appendChild(newCategoryLi);

 }

 function removeCategoryFromPost(event){
     event.preventDefault();
     event.target.removeEventListener('click',removeCategoryFromPost);
     var categoryID = event.target.dataset['category_id'];
     var categoryIDArray = addedCategoryIDs.value.split(",");
     var index = categoryIDArray.indexOf(categoryID);
     categoryIDArray.splice(index, 1);
     var newCategoriesIDs = categoryIDArray.join(",");

        addedCategoryIDs.value = newCategoriesIDs;
     event.target.parentElement.remove();


 }
