document.addEventListener("click", function(e){
    btnClicked = e.target.id;
    var prDate = document.getElementById("pr-date");
    var poNo = document.getElementById("po-no");
    var vendName = document.getElementById("vendor-name");
    var vendCode = document.getElementById("vendor-code");
    var vendCity = document.getElementById("vendor-city");
    var fItem = document.getElementById("f-Item");
    var itemDesc = document.getElementById("item-description");
    var qty = document.getElementById("quantity");
    var unit = document.getElementById("unit");
    var price = document.getElementById("price");



    if(btnClicked === "close-status"){
        
        var disPrDate = document.createAttribute("disabled");
        var disPoNo = document.createAttribute("disabled");
        var disVendName = document.createAttribute("disabled");
        var disVendCode = document.createAttribute("disabled");
        var disVendCity = document.createAttribute("disabled");
        var disFItem = document.createAttribute("disabled");
        var disItemDesc = document.createAttribute("disabled");
        var disQty = document.createAttribute("disabled");
        var disUnit = document.createAttribute("disabled");
        var disPrice = document.createAttribute("disabled");

        prDate.setAttributeNode(disPrDate);
        poNo.setAttributeNode(disPoNo);
        vendName.setAttributeNode(disVendName);
        vendCode.setAttributeNode(disVendCode);
        
        vendCity.setAttributeNode(disVendCity);
        fItem.setAttributeNode(disFItem);
        itemDesc.setAttributeNode(disItemDesc);
        qty.setAttributeNode(disQty);
        unit.setAttributeNode(disUnit);
        price.setAttributeNode(disPrice);

    }

    if(btnClicked === "open-status"){
        prDate.removeAttribute("disabled");
        poNo.removeAttribute("disabled");
        vendName.removeAttribute("disabled");
        vendCode.removeAttribute("disabled");
        vendCity.removeAttribute("disabled");
        fItem.removeAttribute("disabled");
        itemDesc.removeAttribute("disabled");
        qty.removeAttribute("disabled");
        unit.removeAttribute("disabled");
        price.removeAttribute("disabled");
    }
});