//var element = document.getElementById('test');
//
//element.addEventListener('click', function() {
//    alert("click!");
//});

var element = document.getElementsByClassName('shop-picture');

var clicked = false;

for(i=0; i<element.length; i++)
{
    element[i].addEventListener('click', function(e) {
        if(clicked)
            {

                var addedElement = document.getElementsByClassName('goodies_information');
                for(j=0; j<addedElement.length; j++){
                    addedElement[j].parentNode.removeChild(addedElement[j]);
                }

                clicked = false;
            }
        var newLinkText = document.createTextNode("Le Site du Zéro");
        var newDescription = document.createElement('p');
        newDescription.setAttribute('class', 'goodies_information');
        newDescription.appendChild(newLinkText);
        insertAfter(newDescription, e.target);

        clicked = true;
    });
}

function insertAfter(newElement, afterElement) {
    var parent = afterElement.parentNode;

    if (parent.lastChild === afterElement) { // Si le dernier élément est le même que l'élément après lequel on veut insérer, il suffit de faire appendChild()
        parent.appendChild(newElement);

    } else { // Dans le cas contraire, on fait un insertBefore() sur l'élément suivant
        parent.insertBefore(newElement, afterElement.nextSibling);
    }
}

//function removeAfter(newElement, afterElement) {
//    var parent = afterElement.parentNode;
//
//    if (parent.lastChild === afterElement) { // Si le dernier élément est le même que l'élément après lequel on veut insérer, il suffit de faire appendChild()
//        parent.removeChild(newElement);
//
//    } else { // Dans le cas contraire, on fait un insertBefore() sur l'élément suivant
//        parent.nextSibling.removeChild());
//    }
//}
