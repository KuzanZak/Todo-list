// document.querySelectorAll(".themes-items-option").forEach(function (element) {
//     // console.log(element);
//     element.addEventListener("click", function(e){
//         // console.log(this);
//     });
// });

function filter(int) {
    $themes = [];
    document.querySelectorAll(".themes-list-task").forEach(function (themeTask) {
        div = themeTask.parentElement;
        div.parentElement.classList.add("hidden");
        if(themeTask.getAttribute("id") == int) {
            div.parentElement.classList.toggle("displayB");
        }
    });
}
document.getElementById("theme-items").addEventListener("change", function(e){
    filter(this.value);
});


document.querySelectorAll(".themes-list-task").forEach(function (themeTask) {
    // console.log(themeTask.getAttribute("id"));
});



















// document.getElementById("icon-add-theme").addEventListener("click", function(e) {
//     document.getElementById("add-theme").classList.toggle("display");
// });

async function asynAction() {
    try{
        const response = await fetch("api.php?newtheme="+ document.getElementById("newtheme").value);
        const actionJson = await response.json();
        if(actionJson["ok"] == 1) {
            addTheme(document.getElementById("newtheme").value, actionJson["idtheme"]);
        }
        else {
            document.body.innerHTML += "<div>On a un problème</div>";
        }
        console.log(actionJson);
    }
    catch (error){
        console.warn(error);
    }
}

function addTheme(themeName, idtheme){
    document.getElementById("themes").innerHTML += `<label><input type="checkbox" name="theme[]" value=${idtheme}>${themeName}<label>`
}

// document.getElementById("add-button").addEventListener("click", function(event){
//     asynAction();
// })


