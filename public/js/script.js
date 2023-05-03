$(document).ready(function () {
    $('#data_grafik_table').DataTable();

    let date = new Date();
    const month = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    const year = 2021;

    for (let i = 0; i <= parseInt(date.getFullYear())-year; i++) {
        if ((year+i)!=parseInt(date.getFullYear())) {
            $('.tahun_harian').append(`<option value="${year+i}">${year+i}</option>`)
        } else {
            $('.tahun_harian').append(`<option value="${year+i}" selected>${year+i}</option>`)
        }
    }

    month.forEach((m,i)=>(i!=date.getMonth())? $('.bulan_harian').append(`<option value="${i+1}">${m}</option>`):$('.bulan_harian').append(`<option value="${i+1}" selected>${m}</option>`));
});