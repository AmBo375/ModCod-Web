let table = document.getElementById('table-container');

let editingTd;

function deletebtn(button) {
    let row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

function finishTdEdit(td, isOk) {
    if (isOk) {
        td.innerHTML = td.firstChild.value;
    } else {
        td.innerHTML = editingTd.data;
    }
    td.classList.remove('edit-td');
    editingTd = null;
}