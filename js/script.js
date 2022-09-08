// document.getElementById("button").addEventListener("click", function(event) {
//     console.log(this);

// });
async function waitingForResponse() {
    // if(name === "") return;
    const response = await fetch(`https://api.weatherapi.com/v1/current.json?key=bb17b7c52fa045b6aa5113146222906&lang=fr&q=${name}&aqi=yes`);
    const todoList = await response.json();
    if(response.status != 200) {
        alert("Ce lieu n'existe pas!");
        return;
    }
    console.log(todoList);
}
// waitingForResponse();
