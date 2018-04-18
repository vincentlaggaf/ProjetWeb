//gets all the goodies thumbnails
var shopPictures = document.getElementsByClassName('shop-picture');

//for each of them puts a evend listener who will display the informations about the clicked goodie
for(i=0; i<shopPictures.length; i++)
{
    shopPictures[i].addEventListener('click', function(e) {
        var displayedInformations = document.getElementsByClassName('goodies_information');
        for(j=0; j<displayedInformations.length; j++)
        {
            displayedInformations[j].style.display = 'none';
        }
        e.target.nextElementSibling.style.display = 'block';

    });
}

var filterButton = document.getElementById('filterButton');

//add a event listener on the filter button who displays the sidebar for the several type of sorting
filterButton.addEventListener('click', function(){
    var sidebarFilter = document.getElementById('filter');
    if(sidebarFilter.style.display == 'block')
    {
        sidebarFilter.style.display = 'none';
    }
    else
    {
        sidebarFilter.style.display = 'block';
    }
});
