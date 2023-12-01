
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

//// START Current Year
    var currentYear = new Date().getFullYear();

    // Set the current year in the HTML
    document.getElementById('currentYear').textContent = currentYear;
//// END Current Year