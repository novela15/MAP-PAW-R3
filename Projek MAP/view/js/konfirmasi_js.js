let currentAction = "";

function showConfirm(action){

    const popup = document.getElementById("confirmPopup");
    const message = document.getElementById("confirmMessage");

    currentAction = action;

    if(action === "logout"){
        message.innerText = "Apakah Anda Yakin Melakukan Logout?";
    }

    if(action === "delete"){
        message.innerText = "Apakah Anda Yakin Akan Menghapus Data?";
    }

    if(action === "edit"){
        message.innerText = "Apakah Anda Yakin Akan Mengubah Data?";
    }

    popup.style.display = "flex";
}

function closeConfirm(){
    document.getElementById("confirmPopup").style.display = "none";
}

function confirmAction(){

    if(currentAction === "logout"){
        alert("Logout berhasil");
    }

    if(currentAction === "delete"){
        alert("Data dihapus");
    }

    if(currentAction === "edit"){
        alert("Data diubah");
    }

    closeConfirm();
}