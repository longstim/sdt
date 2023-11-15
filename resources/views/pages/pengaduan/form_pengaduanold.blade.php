@extends('layouts.web')
@section('page_heading', $title)
@section('content')

<style>
	#pengaduan-form {
			margin-bottom: 50px;
			margin-left: 200px;
			margin-right: 200px;
			text-align: left;
		}

	@media only screen and (max-width:800px) {
		  /* For mobile phones: */
		  	
			#pengaduan-form {
				margin-bottom: 50px;
				margin-left: 50px;
				margin-right: 50px;
				text-align: left;
			}

			#pengaduan-title{
				font-size:20px;
			}
		}
</style>

<main>
	<div class="banner">
	</div>
		<section id="pengaduan-form">
			<center><h1 id="pengaduan-title">Form {{$title}}</h1>
				<hr style="border: 2px solid #1d809f; width: 70px;" />	
				<p align="center">
					Silahkan isi data pengaduan anda dengan benar.
				</p>
			</center>
			<div class="row">
				<div class="col-md-12">
					<div>
	        	@if(Session::has('message'))
	            	<input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
	            	<input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
	        	@endif
	      	</div>
				<form role="form" id="pengaduan" method="post" action="{{url('proses-pengaduan')}}" >
				{{ csrf_field() }}

					<div class="w3-row">
						<p>
							<label><b>Nama<a style="color:red;">&#42;</a></b></label>
							<input type="text" name="nama" placeholder="Nama" width="100%"  required>
						</p>
						<p>
							<label><b>Alamat<a style="color:red;">&#42;</a></b></label>
							<input type="text" name="alamat" placeholder="Alamat" width="100%"   required>
						</p>
						<p>
							<label><b>Pekerjaan<a style="color:red;">&#42;</a></b></label>
							<input type="text" name="pekerjaan" placeholder="Pekerjaan" width="100%"   required>
						</p>
						<p>
							<label><b>No. HP (Whatsapp)<a style="color:red;">&#42;</a></b></label>
							<input type="text" name="no_hp" placeholder="No. HP (Whatsapp)" width="100%"   required>
						</p>
						<p>
							<label"><b>E-Mail<a style="color:red;">&#42;</a></b></label>
							<input type="email" name="email" placeholder="E-Mail" width="100%" required>
						</p>
						<p>
							<label><b>Jenis Pelayanan<a style="color:red;">&#42;</a></b></label><br/>
							<p>
							 	<label>
                  <input type="radio" name="jenis_pelayanan" id="pengujian" value="Pengujian" required> Pengujian
                </label>
              </p>
              <p>
							 	<label>
                  <input type="radio" name="jenis_pelayanan" id="kalibrasi" value="Kalibrasi"> Kalibrasi
                </label>
              </p>
              <p>
							 	<label>
                  <input type="radio" name="jenis_pelayanan" id="sertifikasi" value="Sertifikasi"> Sertifikasi (LSPro)
                </label>
              </p>
              <p>
							 	<label>
                  <input type="radio" name="jenis_pelayanan" id="konsultansi" value="Konsultansi/Bimtek"> Konsultansi/Bimtek
                </label>
              </p>
              <p>
							 	<label>
                  <input type="radio" name="jenis_pelayanan" id="lainnya" value="Lainnya"> Lainnya
                  <input type="text" name="lainnya_text" placeholder="Lainnya" >
                </label>
              </p>
              <p>
								<label><b>Uraian Pengaduan<a style="color:red;">&#42;</a></b></label><br/>
								<textarea name="uraian_pengaduan" style="width: 100%;" placeholder="" rows="4" class="w3-border" required></textarea>
							</p>
						<br>
						<p style="text-align: center;">
							<button class="button">Simpan</button>
						</p>
					</div>
				</form >
			</div>
			</div>
		</section>
</main>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
	$(document).ready(function () {
	  $('#permohonan-informasi-publik').validate({
	    rules: {
	      nama_pemohon: {
	        required: true
	      },
	      no_identitas: {
	        required: true
	      },
	      alamat: {
	        required: true
	      },
	      pekerjaan: {
	        required: true
	      },
	      no_hp: {
	        required: true
	      },
	      email: {
	        required: true
	      },
	      jenis_pelayanan: {
	        required: true
	      },
	    },
	    messages: {
	      nama_pemohon: {
	        required: "Nama Pemohon harus diisi."
	      },
	      nama_identitas: {
	        required: "No. Identitas harus diisi."
	      },
	      alamat: {
	        required: "Alamat harus diisi."
	      },
	      pekerjaan: {
	        required: "Pekerjaan harus diisi."
	      },
	      no_hp: {
	        required: "No. HP (Whatsapp) harus diisi."
	      },
	      email: {
	        required: "E-Mail harus diisi."
	      },
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	  });

	  //DataTable
      $("#detailtable").DataTable({
        "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	      "responsive": true,
      });

      //SweetAlert Success
      var message = $("#idmessage").val();
      var message_text = $("#idmessage_text").val();

      if(message=="1")
      {
        Swal.fire({     
           icon: 'success',
           title: 'Success!',
           text: message_text,
           showConfirmButton: false,
           timer: 1500
        })
      }


	  //datepicker
	  $('#datepickerawal').datepicker({
	      format: 'dd/mm/yyyy',
	      autoclose: true
		})

		$('#datepickerakhir').datepicker({
	      format: 'dd/mm/yyyy',
	      autoclose: true
		})

	});
</script>

@endsection