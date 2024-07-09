let table = document.getElementById('table-container');

function popup() {
    $('.center').css('display', 'block');
    $('.main').css('display', 'none');
}

function closePopup() {
    $('.center').css('display', 'none');
    $('.main').css('display', 'block');
}

function checkDelete(id) {
    if (confirm('Are you sure you want to delete?')) {
        window.location.href = "deleteRecord.php?id=" + id;
    }
}
