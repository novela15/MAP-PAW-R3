document.addEventListener("DOMContentLoaded", () => {
  const btnUnduh = document.getElementById("btnUnduh");
  const btnInvoices = document.querySelectorAll(".btn-invoice");

  // Aksi tombol unduh
  btnUnduh.addEventListener("click", () => {
    alert("Mengunduh laporan Jurnal Umum...");
  });

  // Aksi ketika ikon bukti pengeluaran di dalam tabel diklik
  btnInvoices.forEach((btn, index) => {
    btn.addEventListener("click", () => {
      alert(`Membuka bukti pengeluaran untuk baris ke-${index + 1}`);
    });
  });
});