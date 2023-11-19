
let clearData = (parent, elements) => {
    
    elements.forEach(element => {
        $(parent).find("[name='" + element + "']").val('');
    });
}
  
//// START Current Year
    var currentYear = new Date().getFullYear();

    // Set the current year in the HTML
    document.getElementById('currentYear').textContent = currentYear;
//// END Current Year