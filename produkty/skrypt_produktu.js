$(".pick_pic").click(function(){
    var zdjecie = document.getElementById(this.id);
    const zrodlo = zdjecie.getAttribute("src");
    var glowne_zdjecie = document.getElementById("prod");
    const zmiana_zdjecia = $(glowne_zdjecie).attr('src', zrodlo);
    
});

$('#rozmiar').click(function(){
    $('#rozmiar option').each(function() {
    if($(this).is(':selected')){
        if($(this).val()){
            $('#btnsubmit').prop("disabled", false);
            tekst = $(this).text();
            przerobka = tekst.split("|");
            $('#ilosc_rozmiaru').val(przerobka[1]);
        }
        else{
            $('#btnsubmit').prop("disabled",true);
        }
    }
});
});
