var navimage = document.getElementById("myImage");
var menuonclick = document.getElementById('menuonclick');

function setImageSource() {
  if (window.matchMedia('(max-width: 834px)').matches) {
      navimage.src = './Images/menuIcon.png';
  } else {
    menuonclick.style.display = "none";
    navimage.style.display = "none";
  }
}

// Call the function initially to set the image source based on the initial screen size
setImageSource();

// Add a resize event listener to update the image source when the screen size changes
window.addEventListener('resize', setImageSource);

// Add onclick event to the menu icon
navimage.addEventListener('click', function() {
  console.log("Clicked on menu icon");
  if (menuonclick.style.display === "none") {
    menuonclick.style.display = "block"; // Ensure the list is displayed
  } else {
    menuonclick.style.display = "none";
  }
});





