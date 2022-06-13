document.addEventListener("click", function(e){
    btnClicked = e.target;
    clickedClass = btnClicked.getAttribute("class");

    
    if(clickedClass === "indicator" || clickedClass === "feather feather-bell align-middle"){

        // call API to change data notification status here
        var notifSection = document.getElementById("notif");
        if(notifSection.lastElementChild.className === "indicator"){
            notifSection.removeChild(notifSection.lastElementChild);
        }
    } 

    if(clickedClass === "indicator green-indicator" || clickedClass === "feather feather-check-circle align-middle"){
        
        // call API to change data validation status here
        var validSection = document.getElementById("validation");
        if(validSection.lastElementChild.className === "indicator green-indicator"){
            validSection.removeChild(validSection.lastElementChild);
        }
    }

    if(clickedClass === "btn btn-primary"){
        // make a transaction validation and added to blockchain 
        alert("Validation Success !!!");
    }

});