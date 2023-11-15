@extends('layouts.web')
@section('page_heading', $title)
@section('content')

<style>
	#permohonan-form {
			margin-bottom: 50px;
			margin-left: 200px;
			margin-right: 200px;
			text-align: left;
		}

	@media only screen and (max-width:800px) {
		  /* For mobile phones: */
		  	
			#contact-form {
				margin-bottom: 50px;
				margin-left: 50px;
				margin-right: 50px;
				text-align: left;
			}

			#contact-map-title{
				font-size:20px;
			}

			.banner-kontak{
        text-align: center;
        width: 100%;
        margin-bottom: 20px;
      }

      .bannertext-kontak h2{
          margin-left: 100px;
          margin-right: 50px;
          text-align: center;
        }

      .bannertext-kontak{
        width: 100%;
        margin:0px;
        text-align: center;
      }

      .bannerimage-kontak{
        position: relative;
        text-align: center;
        width: 70%;
        margin-top: 20px;
        z-index: -1;
      }
		}
</style>

    <section id="jam-layanan" class="content-section">
      <br><br><br><br>
      <center>
        <p align="center">
          <div class="w3-row" id="menu-expertise">
            <div class="w3-half w3-container w3-cell">
              <div class ="w3-animate-bottom" id="address-text"  style="text-align:left;">
								<h1 style="font-size:35pt;">Kontak Kami</h1>
								<h2 style="font-size:20pt;color:#3D3D3D;">Main Office</h2>
								<p>Jalan Sisingamangaraja No. 24, Kelurahan Pasar Merah Barat<br/> 
									Kecamatan Medan Kota, Kota Medan, Provinsi Sumatera Utara<br/>Indonesia, 20217  <br/>
									E-Mail	: bind_medan@kemenperin.go.id <br/>
									Phone   : (061)7363471
								</p>
							</div>
							<div class="w3-animate-bottom" style="text-align:left;"> 
								<p>Follow us on :	<br/>	        	
									<a href="https://www.facebook.com/bspjimedan" target="_blank"><img src="{{asset('image/picture/logo/fb-color.png')}}" height="30px" style="margin-right: 10px;"alt="facebook" href="facebook.com"></a>
							        <a href="https://www.instagram.com/bspjimedan" target="_blank"><img src="{{asset('image/picture/logo/instagram-color.png')}}" height="30px" style="margin-right: 10px;" alt="instagram"></a>
							        <a href="https://www.twitter.com/bspjimedan" target="_blank"><img src="{{asset('image/picture/logo/twitter-color.png')}}" height="30px" style="margin-right: 10px;" alt="twitter"></a>
						       	</p>
							</div>
            </div>
            <div class="w3-half w3-container w3-cell">
            	<center>
									<img src="{{asset('image/picture/contact.jpg')}}" width="400px" style=" box-shadow: 2px 2px 10px 2px lightgray;">
							</center>
            </div>
          </div>
        </p>
      </center>
    </section>

	</header>
	<!-- Effect overlay ketika membuka menu sidebar pada tampilan mobile -->
	<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
	<main>
		<br><br>
		<section id="contact-map">
			<center><h1 id="contact-map-title">BSPJI Medan Map</h1>
				<hr style="border: 2px solid #1d809f; width: 70px;" />
				<p align="center">
					Kunjungi kami
				</p>
				   <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.0813427056546!2d98.68864861426269!3d3.568756751426169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031305d4ea62637%3A0xdbb783617bd1537f!2sBalai%20Riset%20Dan%20Standardisasi%20Industri%20Medan!5e0!3m2!1sid!2sid!4v1597161105986!5m2!1sid!2sid"></iframe>
			</center>
		</section>
	</main>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
	$(document).ready(function () {

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