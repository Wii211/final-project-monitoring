function convertToImage() {
    let resultDiv = document.getElementById("result");
    let myTable = document.getElementById("myTable");

    html2canvas(myTable).then(function (canvas) {
        let img = canvas.toDataURL("image/png");
        resultDiv.innerHTML = '<div class="btn bg-gradient-danger text-white"><i class="fa fa-download"></i> <a class="text-white" download="convert.png" href="' + img + '">Download Gambar Sekarang</a></div>';

    });
}
//click event
let convertBtn = document.getElementById("convert");
convertBtn.addEventListener('click', convertToImage);
