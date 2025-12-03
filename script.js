function cariData() {
    var keyword = document.getElementById("keyword").value;
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Ganti isi tbody dengan hasil pencarian dari PHP
            var tbody = document.getElementById("tabel-laundry").getElementsByTagName("tbody")[0];
            tbody.innerHTML = xhr.responseText;
        }
    };

    // Panggil file PHP pencari (kita buat setelah ini)
    xhr.open("GET", "cari.php?q=" + keyword, true);
    xhr.send();
}