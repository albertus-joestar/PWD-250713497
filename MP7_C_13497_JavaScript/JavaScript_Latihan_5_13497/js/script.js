function fn_ValForm(){
    var sMsg = "";
    var check = /^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$/;
    let nama = document.getElementById("nama");
    let email = document.getElementById("email");
    let umur = document.getElementById("umur");
    let kategori = document.getElementById("kategori");

    if(nama.value == ""){
        sMsg += "\n* Anda belum mengisikan nama";
    }
    if(email.value == ""){
        sMsg += "\n* Anda belum mengisikan email";
    }else if(!check.test(email.value)){
        sMsg += "\n* Email Invalid";
    }
    if(umur.value == ""){
        sMsg += "\n* Anda belum mengisikan umur";
    }else if(umur.value < 7 || umur.value > 70){
    sMsg += "\n* Umur harus antara 7 sampai 70 Tahun";
    }
    if(kategori.value == ""){
        sMsg += "\n* Anda belum memilih kategori";
    }

    if(sMsg != ""){
        alert("Peringatan:\n" + sMsg);
        return false;
    }else{
        let umurs;
        let koleksi;

        if(umur <= 17){
            umurs = "Anggota Pelajar";
        }else{
            umurs = "Anggota Umum";
        }

        switch(kategori.value){
            case "F":
                koleksi = "Fiksi";
            break;

            case "N":
                koleksi = "Non-Fiksi";
            break;

            case "J":
                koleksi = "Jurnal Ilmiah";
            break;
        }

        alert("Terima kasih " + nama.value +"! Anda terdaftar di Koleksi " + koleksi + " " + umurs);
        return true;
    }
}

