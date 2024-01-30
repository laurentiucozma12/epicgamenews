
let clearData = (parent, elements) => {
    
    elements.forEach(element => {
        $(parent).find("[name='" + element + "']").val('');
    });
}
  
//// START lazy loading for ad meme
if (window.matchMedia('(max-width: 1200px)').matches) {
    document.getElementsByClassName('ad-meme-lazy').loading = 'lazy';
}
//// END lazy load

// //// START Current Year
//     var currentYear = new Date().getFullYear();

//     // Set the current year in the HTML
//     document.getElementById('currentYearL').textContent = currentYear;
//     document.getElementById('currentYearM').textContent = currentYear;
//     document.getElementById('currentYearS').textContent = currentYear;
var currentYear = new Date().getFullYear();

// Get elements by class name
var elements = document.getElementsByClassName('currentYear');

// Iterate through the elements and set the current year
for (var i = 0; i < elements.length; i++) {
    elements[i].textContent = currentYear;
}
//// END Current Year