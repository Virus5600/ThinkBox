@extends('template.user')

@section('title', 'Announcements')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 50vh!important; background: #fff url('/images/UI/banners/research.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100vw;">
		<div class="col-6 ml-5" style="position: relative; top: 25%;">
			<h1 class="text-light">Announcements</h1>
			<hr class="hr-thick" style="border-color: white;" />
			<p class="text-light">Be updated with the latest announcements from the university</p>
		</div>
	</div>
</div>

<div class="container-fluid my-5 mb-7">
	<div class="row">
		<div class="col-12 col-md-2">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sort" class="custom-select">
					<option value="author">Author</option>
					<option value="date" selected>Date</option>
					<option value="Title">Title</option>
				</select>
			</div>
		</div>

		<div class="col col-md-10">
			<div class="card-deck">
				<div class="card dark-shadow">
					<div class="card-body">
						<div class="announcement-img" style="background: #fff url('/images/TEMPORARY/home/announcement1.jpg') no-repeat center"></div>
						<h5 class="card-title text-truncate">Payment Options</h5>
						<div class="card-text">
							Good news, Nationalians!
							Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.
							You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.
						</div>
					</div>
					
					<div class="card-footer">
						<div class="dropdown display-inline-block float-left">
							<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-share-alt mr-1"></i> Share
							</a>

							<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
								<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
								{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
								<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text=Payment%20Options&url=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-twitter mr-2"></i>Twitter</a>
							</div>
						</div>

						<a class="float-right text-decoration-none read-more" href="{{ route('announcements.show', [1]) }}">View Details <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>

				<div class="card dark-shadow">
					<div class="card-body">
						<div class="announcement-img" style="background: #fff url('/images/TEMPORARY/home/announcement2.jpg') no-repeat center"></div>
						<h5 class="card-title text-truncate">BDO EasyPay Cash Tuition Program</h5>
						<div class="card-text">
							EASYPAY-CASH-TUITION-PROMO-MECHANICS-v121620
						</div>
					</div>

					<div class="card-footer">
						<div class="dropdown display-inline-block float-left">
							<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-share-alt mr-1"></i> Share
							</a>

							<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
								<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
								{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
								<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text=Payment%20Options&url=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-twitter mr-2"></i>Twitter</a>
							</div>
						</div>

						<a class="float-right text-decoration-none read-more" href="{{ route('announcements.show', [2]) }}">View Details <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>

				<div class="card dark-shadow">
					<div class="card-body">
						<div class="announcement-img" style="background: #fff url('/images/TEMPORARY/home/announcement3.jpg') no-repeat center"></div>
						<h5 class="card-title text-truncate">NU Manila’s COE hosts REFOREST 2020: For Vivid Solutions</h5>
						<div class="card-text">
							The National University Manila’s College of Engineering along with PICE and PSSE student chapters of NU successfully hosted the virtual REFOREST 2020: For Vivid Solutions, last January 29 with 1500 global crowd in attendance.
							Research Forum and Exhibition on Environmental Sustainability and Technologies (REFOREST) aims to produce solutions that will address relevant environmental crises both for present and in the future.
							Reputable plenary speakers, forum discussants and presenters were present to share their knowledge and experience in the significance of wise environmental decision-making in a well-functioning ecosystem.
							To top off the event, National-U’s Electronics and Communications Engineering alumnus, Jayvee Boy H. Agustin, was awarded the Best Paper Presenter for the topic: “Development of Subsystems for a Web-based Survey Tool Using Automatic Speech and Optical Character Recognition with Geotagging Features.”
							With the mission to combat emerging natural and environmental conflicts, REFOREST 2020 will indeed help us attain a sustainable environment.
						</div>
					</div>

					<div class="card-footer">
						<div class="dropdown display-inline-block float-left">
							<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-share-alt mr-1"></i> Share
							</a>

							<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
								<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
								{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
								<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text=Payment%20Options&url=https://www.national-u.edu.ph/payment-options/'><i class="fab fa-twitter mr-2"></i>Twitter</a>
							</div>
						</div>

						<a class="float-right text-decoration-none read-more" href="{{ route('announcements.show', [3]) }}">View Details <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection