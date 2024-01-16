//event listener
document.addEventListener('DOMContentLoaded', function () {
    var addButton = document.getElementById('add');
    var deleteButton = document.getElementById('delete');
    var todoList = document.getElementById('todolist');

    if (addButton && deleteButton && todoList) {
        fetchTodoList();

        $("#todolist").sortable({
            axis: "y",
            update: saveTodoList,
            change: saveTodoList
        });

        addButton.addEventListener('click', addListItem);
        deleteButton.addEventListener('click', removeListItem);
    }
    else {
        console.error('One or more required elements not found.');
    }
});

function addListItem() {
    var li = document.createElement("li");
    var inputValue = document.getElementById("itemtext").value;
    console.log(inputValue);
    var t = document.createTextNode(inputValue);
    li.appendChild(t);
    document.getElementById("todolist").appendChild(li);

    saveTodoList();
}


function removeListItem() {
    var li = document.getElementsByTagName("li");
    document.getElementById("todolist").removeChild(li[0]);

    saveTodoList();
}

function fetchTodoList() {
    console.log("Entered");
    $.ajax({
        url: "webservice.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
            // Check if data.items is defined
            console.log("Data items " +data.items);
            if (Array.isArray(data.items)) {
                // Clear existing list
                $("#todolist").empty();

                for (var i = 0; i < data.items.length; i++) {
                    console.log("Data item"+i+" " +data.items[i]);
                    var li = document.createElement("li");
                    var t = document.createTextNode(data.items[i]);
                    li.appendChild(t);
                    document.getElementById("todolist").appendChild(li);
                }
            } else {
                console.log("Invalid response format:", data);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error fetching to-do list: ", textStatus, errorThrown);
        }
    });
}

function saveTodoList() {
    var todoListArray = [];
    $("#todolist li").each(function () {
        todoListArray.push($(this).text());
    });

    var todoListJson = JSON.stringify({ items: todoListArray });

    $.ajax({
        type: "POST",
        url: "webservice.php",
        data: { todolist: todoListJson },
        success: function (response) {
            console.log("To-do list saved on the server:", response);
        },
        error: function (xhr, status, error) {
            console.error("Error saving to-do list:", error);
        }
    });
}



