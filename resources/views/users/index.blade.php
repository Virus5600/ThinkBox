@extends('template.user')

@section('title', 'Home')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 100vh!important; background: #fff url('/images/UI/banners/index.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100%;">
		<div class="col-6 ml-5 banner-text-adjust">
			<h1 class="text-light h3 h1-md">
				Countless number of IDEAS<br>
				that is INNOVATIVE, in a form of file
			</h1>

			<hr class="hr-thick" style="border-color: white;" />
		</div>
	</div>
</div>

<div class="container-fluid my-5 striped">

	{{-- ANNOUNCEMENT --}}
	<div class="row my-5">
		<div class="col">
			<p class="m-0 text-center">
				<span class="h4 h3-md font-weight-bold text-custom border-custom border border-thick border-left-0 border-top-0 border-right-0 px-3">Latest Announcements</span>
			</p>

			{{-- MAX: 3 ANNOUNCEMENTS --}}
			<div class="row mt-5">
				<div class="col col-md-10 offset-md-1">
					<div class="card-deck">
						@foreach ($announcements as $a)
						<div class="card dark-shadow">
							<div class="card-body">
								<div class="announcement-img" style="background: #fff url('/images/TEMPORARY/home/{{$a->image}}') no-repeat center"></div>
								<h5 class="card-title text-truncate-2">{{$a->title}}</h5>
								<div class="card-text">{!!$a->content!!}</div>
							</div>
							
							<div class="card-footer">
								<div class="dropdown display-inline-block float-left">
									<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-share-alt mr-1"></i> Share
									</a>

									<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
										<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u={{$a->source}}'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link={{$a->source}}'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text={{preg_replace("/\s/", "%20",$a->title)}}&url={{$a->source}}'><i class="fab fa-twitter mr-2"></i>Twitter</a>
									</div>
								</div>

								<a class="float-right text-decoration-none read-more" href="{{ route('announcements.show', [$a->id]) }}">View Details <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none" href="{{route('announcements.index')}}">View More</a></span>
			</p>
		</div>
	</div>

	{{-- LATEST RESEARCH --}}
	<div class="row my-5">
		<div class="col">
			<p class="m-0 text-center">
				<span class="h4 h3-md font-weight-bold text-custom border-custom border border-thick border-left-0 border-top-0 border-right-0 px-3">Latest Research</span>
			</p>

			{{-- MAX: 3 RESEARCH --}}
			<div class="row mt-5">
				<div class="col col-md-10 offset-md-1">
					<div class="card-deck">
						<div class="card dark-shadow">
							<div class="card-body">
								<div class="card-title">
									<div class="row">
										<div class="col-12 d-flex align-items-center">
											<img src="/images/TEMPORARY/home/user1.jpg" class="circular-border" width='50' height='50' draggable='false' alt="User"/>
											<h3 class="h4 mx-2"><a class="text-dark text-decoration-none" href=''>Angelique Lacasandile</a></h3>
										</div>

										<div class="col-12">
											<h4 class="text-truncate text-custom my-3">Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance</h4>
											
											<div class="card-text text-truncate-5">
												The need to address societal issues of every community is a salient aspect that demands attention from the people in authority. These are important responsibilities of every barangay and its official in the Philippines. Profiling each household in the community using information and communication technology could achieve good governance through E-government as its core. Once profile data is aggregated, essential information could provide statistics in labor and employment, family income and expenditures, demography by (population) and (age), water and sanitation, type of housing and education. The focus is based on the profiling of Zone 42 and adding other facets as mentioned above was initiated, with the idea that educational institution around the barangay can help towards the areas included. This paper intends to aid barangay official in budget allocation and decision making in their respective governed …
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="card-footer">
								<div class="dropdown display-inline-block float-left">
									<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-share-alt mr-1"></i> Share
									</a>

									<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
										<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u=https://dl.acm.org/doi/abs/10.1145/3421682.3421691'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link=https://dl.acm.org/doi/abs/10.1145/3421682.3421691'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text=Payment%20Options&url=https://dl.acm.org/doi/abs/10.1145/3421682.3421691'><i class="fab fa-twitter mr-2"></i>Twitter</a>
									</div>
								</div>

								<a class="float-right text-decoration-none read-more" target="_blank" href='https://scholar.google.com/scholar?oi=bibs&cluster=13452525736665322785&btnI=1&hl=en'>View Details <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>

						<div class="card dark-shadow">
							<div class="card-body">
								<div class="card-title">
									<div class="row">
										<div class="col-12 d-flex align-items-center">
											<img src="/images/TEMPORARY/home/user2.jpg" class="circular-border" width='50' height='50' draggable='false' alt="User"/>
											<h3 class="h4 mx-2"><a class="text-dark text-decoration-none" href=''>Joseph Marvin Imperial</a></h3>
										</div>

										<div class="col-12">
											<h4 class="text-truncate text-custom my-3">Exploring Hybrid Linguistic Feature Sets to Measure Filipino Text Readability</h4>
											
											<div class="card-text text-truncate-5">
												Proper identification of the difficulty level of materials prescribed as required readings in an educational setting is key towards effective learning in children. Educators and publishers have relied on readability formulas in predicting text readability. While these formulas abound in the English language, limited work has been done on automatic readability assessment for the Filipino language. In this study, we build upon the previous works using traditional (TRAD) and lexical (LEX) linguistic features by incorporating language model (LM) features for possible improvement in identifying readability levels of Filipino storybooks. Results showed that combining LM predictors to TRAD and LEX, forming a hybrid feature set, increased the performances of readability models trained using Logistic Regression and Support Vector Machines by up to  25% – 32%. From the results of performing feature selection using …
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card-footer">
								<div class="dropdown display-inline-block float-left">
									<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-share-alt mr-1"></i> Share
									</a>

									<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
										<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u=https://ieeexplore.ieee.org/abstract/document/9310473'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link=https://ieeexplore.ieee.org/abstract/document/9310473'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text=Payment%20Options&url=https://ieeexplore.ieee.org/abstract/document/9310473'><i class="fab fa-twitter mr-2"></i>Twitter</a>
									</div>
								</div>

								<a class="float-right text-decoration-none read-more" href='https://scholar.google.com/scholar?oi=bibs&cluster=8940472677338940170&btnI=1&hl=en'>View Details <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>

						<div class="card dark-shadow">
							<div class="card-body">
								<div class="card-title">
									<div class="row">
										<div class="col-12 d-flex align-items-center">
											<img src="/images/TEMPORARY/home/user3.jpg" class="circular-border" width='50' height='50' draggable='false' alt="User"/>
											<h3 class="h4 mx-2"><a class="text-dark text-decoration-none" href=''>Manolito Octaviano Jr.</a></h3>
										</div>

										<div class="col-12">
											<h4 class="text-truncate text-custom my-3">A Speaker Accent Recognition System for Filipino Language</h4>
											
											<div class="card-text text-truncate-5">
												This paper presents the development of an accent recognition system for the native speakers of Bikol and Tagalog using deep learning. The results of the work serve as baseline for the advancement of recognizing speakers with Tagalog and Bikol accents in Filipino language. A monologue written in Filipino is prepared as script for the development of the speech corpus. The script is used to capture the Bikol accent and Tagalog accent in the recordings. The corpus was validated, cleaned and divided into 80: 20 ratios for training and testing. Afterwards, Praat is utilized to analyze and extract prosodic features such as F1 and energy of speech. The model was tested and yields 79.28% and 78.33% accuracy for Tagalog and Bikol accent, respectively.
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card-footer">
								<div class="dropdown display-inline-block float-left">
									<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-share-alt mr-1"></i> Share
									</a>

									<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
										<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u=https://scholar.google.com/scholar?oi=bibs&cluster=6255688371458420982&btnI=1&hl=en'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link=https://scholar.google.com/scholar?oi=bibs&cluster=6255688371458420982&btnI=1&hl=en'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text=Payment%20Options&url=https://scholar.google.com/scholar?oi=bibs&cluster=6255688371458420982&btnI=1&hl=en'><i class="fab fa-twitter mr-2"></i>Twitter</a>
									</div>
								</div>

								<a class="float-right text-decoration-none read-more" href='https://scholar.google.com/scholar?oi=bibs&cluster=6255688371458420982&btnI=1&hl=en'>View Details <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none" href="{{route('research')}}">View More</a></span>
			</p>
		</div>
	</div>

	{{-- LATEST INNOVATIONS --}}
	<div class="row my-5">
		<div class="col">
			<p class="m-0 text-center">
				<span class="h4 h3-md font-weight-bold text-custom border-custom border border-thick border-left-0 border-top-0 border-right-0 px-3">Latest Innovations</span>
			</p>

			{{-- MAX: 3 INNOVATIONS --}}
			<div class="row mt-5">
				<div class="col col-md-10 offset-md-1">
					<div class="card-deck">
						<div class="card dark-shadow">
							<div class="card-body">
								<div class="card-title">
									<div class="row">
										<div class="col-12 d-flex align-items-center">
											<img src="/images/TEMPORARY/home/user1.jpg" class="circular-border" width='50' height='50' draggable='false' alt="User"/>
											<h3 class="h4 mx-2"><a class="text-dark text-decoration-none" href=''>Angelique Lacasandile</a></h3>
										</div>

										<div class="col-12">
											<h4 class="text-truncate text-custom my-3">Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance</h4>
											
											<div class="card-text text-truncate-5">
												The need to address societal issues of every community is a salient aspect that demands attention from the people in authority. These are important responsibilities of every barangay and its official in the Philippines. Profiling each household in the community using information and communication technology could achieve good governance through E-government as its core. Once profile data is aggregated, essential information could provide statistics in labor and employment, family income and expenditures, demography by (population) and (age), water and sanitation, type of housing and education. The focus is based on the profiling of Zone 42 and adding other facets as mentioned above was initiated, with the idea that educational institution around the barangay can help towards the areas included. This paper intends to aid barangay official in budget allocation and decision making in their respective governed …
											</div>
										</div>
									</div>
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

								<a class="float-right text-decoration-none read-more" target="_blank" href='https://scholar.google.com/scholar?oi=bibs&cluster=13452525736665322785&btnI=1&hl=en'>View Details <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>

						<div class="card dark-shadow">
							<div class="card-body">
								<div class="card-title">
									<div class="row">
										<div class="col-12 d-flex align-items-center">
											<img src="/images/TEMPORARY/home/user2.jpg" class="circular-border" width='50' height='50' draggable='false' alt="User"/>
											<h3 class="h4 mx-2"><a class="text-dark text-decoration-none" href=''>Joseph Marvin Imperial</a></h3>
										</div>

										<div class="col-12">
											<h4 class="text-truncate text-custom my-3">Exploring Hybrid Linguistic Feature Sets to Measure Filipino Text Readability</h4>
											
											<div class="card-text text-truncate-5">
												Proper identification of the difficulty level of materials prescribed as required readings in an educational setting is key towards effective learning in children. Educators and publishers have relied on readability formulas in predicting text readability. While these formulas abound in the English language, limited work has been done on automatic readability assessment for the Filipino language. In this study, we build upon the previous works using traditional (TRAD) and lexical (LEX) linguistic features by incorporating language model (LM) features for possible improvement in identifying readability levels of Filipino storybooks. Results showed that combining LM predictors to TRAD and LEX, forming a hybrid feature set, increased the performances of readability models trained using Logistic Regression and Support Vector Machines by up to  25% – 32%. From the results of performing feature selection using …
											</div>
										</div>
									</div>
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

								<a class="float-right text-decoration-none read-more" href='https://scholar.google.com/scholar?oi=bibs&cluster=8940472677338940170&btnI=1&hl=en'>View Details <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>

						<div class="card dark-shadow">
							<div class="card-body">
								<div class="card-title">
									<div class="row">
										<div class="col-12 d-flex align-items-center">
											<img src="/images/TEMPORARY/home/user3.jpg" class="circular-border" width='50' height='50' draggable='false' alt="User"/>
											<h3 class="h4 mx-2"><a class="text-dark text-decoration-none" href=''>Manolito Octaviano Jr.</a></h3>
										</div>

										<div class="col-12">
											<h4 class="text-truncate text-custom my-3">A Speaker Accent Recognition System for Filipino Language</h4>
											
											<div class="card-text text-truncate-5">
												This paper presents the development of an accent recognition system for the native speakers of Bikol and Tagalog using deep learning. The results of the work serve as baseline for the advancement of recognizing speakers with Tagalog and Bikol accents in Filipino language. A monologue written in Filipino is prepared as script for the development of the speech corpus. The script is used to capture the Bikol accent and Tagalog accent in the recordings. The corpus was validated, cleaned and divided into 80: 20 ratios for training and testing. Afterwards, Praat is utilized to analyze and extract prosodic features such as F1 and energy of speech. The model was tested and yields 79.28% and 78.33% accuracy for Tagalog and Bikol accent, respectively.
											</div>
										</div>
									</div>
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

								<a class="float-right text-decoration-none read-more" href='https://scholar.google.com/scholar?oi=bibs&cluster=6255688371458420982&btnI=1&hl=en'>View Details <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none" href="{{ route('innovations') }}">View More</a></span>
			</p>
		</div>
	</div>

	{{-- FACULTY --}}
	<div class="row my-5">
		<div class="col text-center">
			<span class="h4 h3-md font-weight-bold text-custom border-custom border border-thick border-left-0 border-top-0 border-right-0 px-3">Meet Our Faculty</span>

			{{-- MAX: 4 FACULTY --}}
			<div class="row mt-5">
				<div class="col-10 col-sm-12 col-md-10 offset-1 offset-sm-0 offset-md-1">
					<div class="card-deck">
						@foreach($staff as $s)
						<div class="card dark-shadow">
							<div class="card-header p-0" style="background: #fff url('/images/TEMPORARY/home/{{$s->avatar}}') no-repeat center; background-size: cover;">
								<div class="p-0 m-0 blur-backdrop">
									<img class="p-0 m-0 img-fluid faculty-img" src='/images/TEMPORARY/home/{{$s->avatar}}'>
								</div>
							</div>
							<div class="card-body">
								<div class="card-title">
									<h4 class="font-weight-bold">{{$s->name}}</h4>
								</div>

								<p class="card-text">{{$s->position}}</p>
							</div>
							
							<div class="card-footer">
								<a class="float-right text-decoration-none read-more" href="{{ route('faculty.show', [$s->id]) }}">View Profile <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none" href="{{ route('faculty.index') }}">View More</a></span>
			</p>
		</div>
	</div>
</div>
@endsection