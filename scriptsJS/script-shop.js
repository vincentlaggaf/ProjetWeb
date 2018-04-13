var shopPictures = document.getElementsByClassName('shop-picture');

for(i=0; i<shopPictures.length; i++)
{
    shopPictures[i].addEventListener('click', function(e) {
        var displayedInformations = document.getElementsByClassName('invisible');
        for(j=0; j<displayedInformations.length; j++)
        {
            displayedInformations[j].style.display = 'none';
        }
        e.target.nextElementSibling.style.display = 'block';

    });
}

//var categoryButton = document.getElementById('categoryButton');
//categoryButton.addEventListener('click', function(){
//
//    var xhr = new XMLHttpRequest();
//    xhr.open('POST', '\projetWeb\pagePHP\shop.php');
//    xhr.send('category=1');
//    alert("test");
//})

function insertAfter(newElement, afterElement) {
    var parent = afterElement.parentNode;

    if (parent.lastChild === afterElement) { // Si le dernier élément est le même que l'élément après lequel on veut insérer, il suffit de faire appendChild()
        parent.appendChild(newElement);

    } else { // Dans le cas contraire, on fait un insertBefore() sur l'élément suivant
        parent.insertBefore(newElement, afterElement.nextSibling);
    }
}
