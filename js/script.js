document.getElementById("icon-add-theme").addEventListener("click", function(e) {
    document.getElementById("add-theme").classList.toggle("display");
});

async function asynAction() {
    try{
        const response = await fetch("addTheme.php?newtheme="+ document.getElementById("newtheme").value);
        const actionJson = await response.json();
        if(actionJson["ok"] ==1) {
            addTheme(document.getElementById("newtheme").value, actionJson["idtheme"]);
        }
        else {
            document.body.innerHTML += "<div>On a un problème</div>";
        }
        console.log(actionJson);
    }
    catch (error){
        console.warn(error)
    }
}

function addTheme(themeName, idtheme){
    document.getElementById("themes").innerHTML += `<label><input type="checkbox" name="theme[]" value=${idtheme}>${themeName}<label>`
}

document.getElementById("add-button").addEventListener("click", function(event){
    console.log(document.getElementById("newtheme").value);
    asynAction();
})
