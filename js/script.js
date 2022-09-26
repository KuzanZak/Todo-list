function filter(int) {
    document.querySelectorAll(".list-items").forEach(function (list) {
        const array = list.getAttribute("data-theme").split(",");
        list.classList.add("hidden");
        if(array.includes(int)){
            list.classList.remove("hidden");
        }
    });
}
function addTheme(themeName, idtheme){
    document.getElementById("themes").innerHTML += `<label><input type="checkbox" name="theme[]" value=${idtheme}>${themeName}<label>`
}   

if (window.location.href == "http://localhost/todo_list/index.php?action=create"){
    document.getElementById("icon-add-theme").addEventListener("click", function(e) {
        document.getElementById("add-theme").classList.toggle("display");
    });
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
    document.getElementById("add-button").addEventListener("click", function(event){
        asynAction();
    })
}


if (window.location.href == "http://localhost/todo_list/index.php") {
    document.getElementById("theme-items").addEventListener("change", function(e){
        filter(this.value);
    });
    document.querySelectorAll(".list-items").forEach(function (list){
        list.style.backgroundColor = "#" + list.getAttribute("data-color");
    })
}    


