$("#loader").loading();
$(function () {

    $('#qrcode').qrcode({
        render: 'div',
        size: '160',
        text: 'amr'
    });

    $(document).ready(function () {
            setTimeout(() => {
                let element = $("#widget"); // global variable
                html2canvas(element, {
                    onrendered: function (canvas) {
                        var imgData = canvas.toDataURL('image/png');
                        var doc = new jsPDF('p', 'mm',);
                        doc.addImage(imgData, 'PNG', 0, 0);
                        doc.save('sample-file.pdf');
                        setTimeout(() => {
                            window.close();
                        }, 1000)
                    },
                    width: 793.706,
                    height: 1122.52,
                    allowTaint: true,
                    dpi: 72,
                    scale: 3
                });    
            }, 2000)
    });
});

