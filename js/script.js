document.querySelectorAll(".list-checkbox").forEach(checkbox => 
    checkbox.addEventListener("click", () => 
    console.log(checkbox))
);
    
// async function waitingForResponse() {
//     // if(name === "") return;
//     try {
//         const response = await fetch(`http://localhost/todo_list/index.php`);
//         const todoList = await response.json();
//         console.log(todoList);
//     }
//     catch(error) {
//         console.error("Unable to load todolist datas from the server : " + error);
//     }   
// }
// waitingForResponse();



