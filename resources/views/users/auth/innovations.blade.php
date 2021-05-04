@extends('template.user')

@section('title', 'Innovations')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 50vh!important; background: #fff url('/images/UI/banners/innovations.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100vw;">
		<div class="col-6 ml-5" style="position: relative; top: 25%;">
			<h1 class="text-light h3 h1-md">Innovations</h1>
			<hr class="hr-thick" style="border-color: white;" />
			<p class="text-light">Explore the innovations made by our researchers.</p>
		</div>
	</div>
</div>

<div class="container-fluid my-5 mb-7">
	<div class="row">
		<div class="col-12 col-lg-3">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Filter by Department</span>
			<div class="input-group">
				<select name="dept" class="custom-select">
					<option value="All" selected>All</option>
					<option value="CompSci">Computer Science</option>
				</select>
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

		<div class="col-12 col-lg-9">
			<div class="row justify-content-center my-3 mx-1">
				{{-- INNOVATIONS --}}
				<div class="col-12 col-lg-4 p-0 my-3">
					<div class="mx-2 my-1 invisiborder rounded dark-shadow d-flex flex-d-col h-100">
						<div class="card-body">
							<div class="card-title">
								<div class="row">
									<div class="col-12 align-items-center">
										<div class="row">
											<div class="col-12 col-md-3 text-center px-0">
												<img src="/images/TEMPORARY/home/user1.jpg" class="circle-border img-fluid" style="max-width: 75%;" draggable='false' alt="User"/>
											</div>

											<div class="col-12 col-md-9 ml-0 pl-1 text-center text-sm-left">
												<a class="text-dark text-decoration-none" href=''>
													<h5 class="h2 h5-lg m-0">Angelique Lacasandile</h5>
													<p class="h4 h6-lg m-0">Department Chair</p>
												</a>
											</div>
										</div>
									</div>

									<div class="col-12">
										<h4 class="text-truncate-2 my-3 tooltip-html" data-toggle="tooltip" data-placement="bottom" title="Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance">
											Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance
										</h4>
										
										<div class="card-text text-truncate-5">
											The need to address societal issues of every community is a salient aspect that demands attention from the people in authority. These are important responsibilities of every barangay and its official in the Philippines. Profiling each household in the community using information and communication technology could achieve good governance through E-government as its core. Once profile data is aggregated, essential information could provide statistics in labor and employment, family income and expenditures, demography by (population) and (age), water and sanitation, type of housing and education. The focus is based on the profiling of Zone 42 and adding other facets as mentioned above was initiated, with the idea that educational institution around the barangay can help towards the areas included. This paper intends to aid barangay official in budget allocation and decision making in their respective governed …
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="card-footer bg-transparent">
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
				</div>

				<div class="col-12 col-lg-4 p-0 my-3">
					<div class="mx-2 my-1 invisiborder rounded dark-shadow d-flex flex-d-col h-100">
						<div class="card-body">
							<div class="card-title">
								<div class="row">
									<div class="col-12 align-items-center">
										<div class="row">
											<div class="col-12 col-md-3 text-center px-0">
												<img src="/images/TEMPORARY/home/user2.jpg" class="circle-border img-fluid" style="max-width: 75%;" draggable='false' alt="User"/>
											</div>

											<div class="col-12 col-md-9 ml-0 pl-1 text-center text-sm-left">
												<a class="text-dark text-decoration-none" href=''>
													<h5 class="h2 h5-lg m-0">Joseph Marvin Imperial</h5>
													<p class="h4 h6-lg m-0">Professor</p>
												</a>
											</div>
										</div>
									</div>

									<div class="col-12">
										<h4 class="text-truncate-2 my-3 tooltip-html" data-toggle="tooltip" data-placement="bottom" title="Exploring Hybrid Linguistic Feature Sets to Measure Filipino Text Readability">
											Exploring Hybrid Linguistic Feature Sets to Measure Filipino Text Readability
										</h4>
										
										<div class="card-text text-truncate-5">
											Proper identification of the difficulty level of materials prescribed as required readings in an educational setting is key towards effective learning in children. Educators and publishers have relied on readability formulas in predicting text readability. While these formulas abound in the English language, limited work has been done on automatic readability
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="card-footer bg-transparent">
							<div class="dropdown display-inline-block float-left">
								<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-share-alt mr-1"></i> Share
								</a>

								<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
									<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u=https://ieeexplore.ieee.org/abstract/document/9310473'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
									{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link=https://ieeexplore.ieee.org/abstract/document/9310473'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
									<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text=Payment%20Options&url=https://scholar.google.com/scholar?oi=bibs&cluster=8940472677338940170&btnI=1&hl=en'><i class="fab fa-twitter mr-2"></i>Twitter</a>
								</div>
							</div>

							<a class="float-right text-decoration-none read-more" target="_blank" href='https://ieeexplore.ieee.org/abstract/document/9310473'>View Details <i class="fas fa-chevron-right"></i></a>
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-4 p-0 my-3">
					<div class="mx-2 my-1 invisiborder rounded dark-shadow d-flex flex-d-col h-100">
						<div class="card-body">
							<div class="card-title">
								<div class="row">
									<div class="col-12 align-items-center">
										<div class="row">
											<div class="col-12 col-md-3 text-center px-0">
												<img src="/images/TEMPORARY/home/user3.jpg" class="circle-border img-fluid" style="max-width: 75%;" draggable='false' alt="User"/>
											</div>

											<div class="col-12 col-md-9 ml-0 pl-1 text-center text-sm-left">
												<a class="text-dark text-decoration-none" href=''>
													<h5 class="h2 h5-lg m-0">Manolito Octaviano Jr.</h5>
													<p class="h4 h6-lg m-0">Professor</p>
												</a>
											</div>
										</div>
									</div>

									<div class="col-12">
										<h4 class="text-truncate-2 my-3 tooltip-html" data-toggle="tooltip" data-placement="bottom" title="A Speaker Accent Recognition System for Filipino Language">
											A Speaker Accent Recognition System for Filipino Language
										</h4>
										
										<div class="card-text text-truncate-5">
											This paper presents the development of an accent recognition system for the native speakers of Bikol and Tagalog using deep learning. The results of the work serve as baseline for the advancement of recognizing speakers with Tagalog and Bikol accents in Filipino language. A monologue written in Filipino is prepared as script for the development of the speech corpus. The script is used to capture the Bikol accent and Tagalog accent in the recordings. The corpus was validated, cleaned and divided into 80: 20 ratios for training and testing. Afterwards, Praat is utilized to analyze and extract prosodic features such as F1 and energy of speech. The model was tested and yields 79.28% and 78.33% accuracy for Tagalog and Bikol accent, respectively.
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="card-footer bg-transparent">
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

							<a class="float-right text-decoration-none read-more" target="_blank" href='https://scholar.google.com/scholar?oi=bibs&cluster=6255688371458420982&btnI=1&hl=en'>View Details <i class="fas fa-chevron-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection