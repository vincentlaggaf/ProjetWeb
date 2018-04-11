//var element = document.getElementById('test');
//
//element.addEventListener('click', function() {
//    alert("click!");
//});

var element = document.getElementsByClassName('shop-picture');

for(i=0; i<element.length; i++)
{
    element[i].addEventListener('click', function(e) {
//        if(document.getElementById('goodies_information'))
//        {
//            var addedElement = document.getElementById('goodies_information');
//            addedElement.parentNode.removeChild(addedElement);
//        }
        var msg= "<?php echo 'bonjour' ?>";
        alert(msg);
    });
}

function createDescription(clickedElement){
    var newLinkText = document.createTextNode("Le Site du Zéro");

        var information = document.createElement('div');

        var informationPart1 = document.createElement('div');
        informationPart1.setAttribute('class', 'goodies_information_part');
        var picture = document.createElement('img');
        picture.setAttribute('src', clickedElement('src'));
        picture.setAttribute('alt', clickedElement('alt'));
        picture.setAttribute('title', clickedElement('title'));
        picture.setAttribute('class', 'goodies-picture');
        var goodieName = document.createElement('div');
        goodieName.setAttribute('class', 'info_goodies info_goodies_margin');

        var informationPart2 = document.createElement('div');
        informationPart2.setAttribute('class', 'goodies_information_part');


        var informationPart3 = document.createElement('div');
        informationPart3.setAttribute('class', 'goodies_information_part');


        information.setAttribute('id', 'goodies_information');
        newDescription.appendChild(test);
        insertAfter(information, clickedElement);
}

function insertAfter(newElement, afterElement) {
    var parent = afterElement.parentNode;

    if (parent.lastChild === afterElement) { // Si le dernier élément est le même que l'élément après lequel on veut insérer, il suffit de faire appendChild()
        parent.appendChild(newElement);

    } else { // Dans le cas contraire, on fait un insertBefore() sur l'élément suivant
        parent.insertBefore(newElement, afterElement.nextSibling);
    }
}
