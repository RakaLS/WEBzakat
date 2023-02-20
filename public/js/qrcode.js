function saveButton () {
    var saveButton = document.getElementById("save-button");

saveButton.addEventListener("click", function() {
  // mendapatkan nama file gambar QR code dari halaman web
  var fileName = document.getElementById("file-name").textContent;
  
  // mendapatkan URL gambar QR code dari halaman web
  var imageUrl = document.getElementById("qr-code-image").getAttribute("src");
  
  // membuat elemen link dan menentukan propertinya
  var link = document.createElement("a");
  link.download = fileName;
  link.href = imageUrl;
  
  // mengklik link secara otomatis

}

