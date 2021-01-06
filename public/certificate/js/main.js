$("#loader").loading();

// const { jsPDF } = window.jspdf;
// const { Canvg } =  window.canvg;

// function convertPDF() {
//     var doc = new jsPDF();
//     var elementHTML = $('#widget').html();

//     doc.html(elementHTML, {
//         callback: function (doc) {
//             doc.save();
//         },
//         x: 0,
//         y: 0
//     });

//     // Save the PDF
//     // doc.save('sample-document.pdf');
// }

function convertPDF() {
    let page = document.getElementById('widget');
    html2PDF(page, {
        jsPDF: {
          format: 'a4',
        },
        imageType: 'image/jpeg',
        output: './pdf/generate.pdf'
      });    
}

$(function () {

    $('#qrcode').qrcode({
        render: 'div',
        size: '160',
        text: 'amr'
    });

    $(document).ready(function () {
        setTimeout(() => {


            convertPDF();


            // let element = $("#widget"); // global variable

            // var w = element.width();
            // var h = element.height();
            // console.log(w, h);

            // element.css({
            //     'transform': 'scale(3)',
            //     '-ms-transform': 'scale(3)',
            //     '-webkit-transform': 'scale(3)',
            //     'transform-origin': '0 0'
            // });

            // html2canvas(element, {
            //     onrendered: function (canvas) {
            //         element.css({
            //             'transform': '',
            //             '-ms-transform': '',
            //             '-webkit-transform': ''
            //         });
            //         var imgData = canvas.toDataURL('image/png');
            //         var doc = new jsPDF('p', 'mm');
            //         doc.addImage(imgData, 'PNG', 0, 0);
            //         doc.save('sample-file.pdf');
            //         setTimeout(() => {
            //             // window.close();
            //         }, 1000)
            //     },
            //     width: w*3,
            //     height: h*3,
            //     // allowTaint: true,
            //     // dpi: 300,
            //     scale: 3
            // });
        }, 1000)
    });
});

