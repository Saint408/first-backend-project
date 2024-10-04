$(document).ready(function(){
   //
   $('#tombol-cari').hide();
//event ketika keyword ditilis
$('#keyword').on('keyup', function(){

   //muculkan icon loading
   $('.loader').show();

   //ajak menggunakan load
   //$('#container').load('ajax/mahasiswa.php?keyword='+ $('#keyword').val());

   $.get('ajax/mahasiswa.php?keyword='+ $('#keyword').val(),function(data){

      $('#container').html(data);
      $('.loader').hide();
   })
});


});
