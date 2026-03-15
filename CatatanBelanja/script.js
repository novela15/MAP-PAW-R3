document.addEventListener("DOMContentLoaded", function(){

const tableBody = document.querySelector(".custom-table tbody");
const buatButton = document.querySelector(".buat-wrapper");

// tambah data
buatButton.addEventListener("click", function(){

    const tanggal = prompt("Tanggal:");
    const akun = prompt("Akun Anggaran:");
    const volume = prompt("Volume:");
    const satuan = prompt("Satuan:");
    const total = prompt("Jumlah Total:");
    const keterangan = prompt("Keterangan:");

    if(!tanggal) return;

    const row = document.createElement("tr");

    row.innerHTML = `
        <td>${tanggal}</td>
        <td>${akun}</td>
        <td>${volume}</td>
        <td>${satuan}</td>
        <td>${total}</td>
        <td>${keterangan}</td>
        <td>-</td>
        <td class="action-cell">
            <div class="btn-mini-disabled bg-red">
                <i class="fa-solid fa-trash"></i>
            </div>
            <div class="btn-mini-disabled bg-teal">
                <i class="fa-solid fa-pencil"></i>
            </div>
        </td>
    `;

    tableBody.appendChild(row);

    pasangEvent(row);
});

function pasangEvent(row){

    const tombol = row.querySelectorAll(".btn-mini-disabled");

    const deleteBtn = tombol[0];
    const editBtn = tombol[1];

    deleteBtn.addEventListener("click", function(){
        if(confirm("Hapus data ini?")){
            row.remove();
        }
    });

    editBtn.addEventListener("click", function(){

        const cells = row.querySelectorAll("td");

        cells[0].innerText = prompt("Tanggal:", cells[0].innerText);
        cells[1].innerText = prompt("Akun:", cells[1].innerText);
        cells[2].innerText = prompt("Volume:", cells[2].innerText);
        cells[3].innerText = prompt("Satuan:", cells[3].innerText);
        cells[4].innerText = prompt("Total:", cells[4].innerText);
        cells[5].innerText = prompt("Keterangan:", cells[5].innerText);

    });

}

const rows = document.querySelectorAll(".custom-table tbody tr");
rows.forEach(row => {
    pasangEvent(row);
});

});