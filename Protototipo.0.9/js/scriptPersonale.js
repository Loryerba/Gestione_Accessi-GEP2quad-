function setPreviousDate(){
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("datameeting")[0].setAttribute('min', today);
    
}

