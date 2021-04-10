@extends('template.user')

@section('title', 'Faculty')

@section('body')
<h2 class="mx-5 my-4"><a href="{{route('faculty.show', [$id])}}" class="text-dark text-decoration-none font-weight-normal"><i class="fas fa-chevron-left fa-lg mr-3"></i>Profile</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	{{-- DETAILS --}}
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="row">
				<div class="col-12 col-md-4 text-center">
					<img src='/images/TEMPORARY/home/user{{$id}}.jpg' class='img-fluid invisiborder circle-border w-75'/>
				</div>

				<div class="col-12 col-md-8">
					<h1>Dr. Angelique Lacasandile</h1>
					<h4>Department Chair, National University</h4>
					<h4 class="font-weight-normal"><em>Computer Science</em></h4>
					<br>
					<p class="text-muted">
						<span class="mr-3"><i class="fas fa-phone-alt mr-2 fa-sm text-primary"></i>+639667125676</span>
						<span class="ml-3"><i class="fas fa-envelope mr-2 fa-sm text-primary"></i>angelique.lacasandile@gmail.com</span>
					</p>

					<p>
						<a href="" data-toggle="tooltip" data-placement="top" title="Facebook" class="mx-1"><i class="fab fa-facebook text-dark fa-2x"></i></a>
						<a href="" data-toggle="tooltip" data-placement="top" title="Google Scholar" class="mx-1"><i class="fas fa-atom text-light fa-2x bg-dark invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" data-toggle="tooltip" data-placement="top" title="Twitter" class="mx-1"><i class="fab fa-twitter text-light fa-2x bg-dark invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" data-toggle="tooltip" data-placement="top" title="LinkedIn" class="mx-1"><i class="fab fa-linkedin-in text-light fa-2x bg-dark invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" data-toggle="tooltip" data-placement="top" title="Facebook" class="mx-1"><i class="fab fa-github text-dark fa-2x"></i></a>
					</p>
				</div>
			</div>
		</div>
	</div>
	
	{{-- PUBLISHED RESEARCH --}}
	<h2 class="text-custom-2 my-2 mb-3">PUBLISHED RESEARCH</h2>
	<hr class="hr-thick my-3">

	<div class="row my-3">
		<div class="col-12 col-md-3 order-0">
			<div class="input-group my-3">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sort" class="custom-select">
					<option value="titleAsc" selected>Title (A-Z)</option>
					<option value="titleDesc">Title (Z-A)</option>
					<option value="datePublished">Date Published</option>
				</select>
			</div>
		</div>

		<div class="col-12 col-md-9">
			<div class="row">
				<div class="col my-3 mx-5 bg-custom-light p-3">
					<p class="font-weight-bold">
						Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance
					</p>

					<p>
						<small><em>Angelique D. Lacasandile, Mideth B. Abisado, Rogel M. Labanan, Lalaine P. Abad | August 2020</em></small>
					</p>

					<p class="text-truncate-3">
						The need to address societal issues of every community is a salient aspect that demands attention from the people in authority. These are important responsibilities of every barangay and its official in the Philippines. Profiling each household in the community using information and communication technology could achieve good governance through E-government as its core. Once profile data is aggregated, essential information could provide statistics in labor and employment, family income and expenditures, demography by (population) and (age), water and sanitation, type of housing and education. The focus is based on the profiling of Zone 42 and adding other facets as mentioned above was initiated, with the idea that educational institution around the barangay can help towards the areas included. This paper intends to aid barangay official in budget allocation and decision making in their respective governed …
					</p>
				</div>
			</div>

			@for ($i = 0; $i < 3; $i++)
			<div class="row">
				<div class="col my-3 mx-5 bg-custom-light p-3">
					<p class="font-weight-bold">
						e-government concept from cabal to community: a demand side perspective in the philippines utilizing information technology systems
					</p>

					<p>
						<small><em>Angelique D. Lacasandile, Jasmine D. Niguidula | August 2020</em></small>
					</p>

					<p class="text-truncate-3">
						E-government in the Philippines is a recent development that aims to utilize the benefits of technology to provide improved and quality service to the citizens. The researcher tends to respond to produce demand-side oriented assessment of e-government and examine whether the users access to ICT's and the Internet and their attitudes toward e-government can be a positive contributing factor in the easier adoption of e-government system. The website Barangay Information Profiling System (BIPS) has feature that can easily generate reports needed to be submitted by the barangay at Manila Barangay Bureau, Department of Local Government Unit and other government agencies and was designed based on the needs address of the same barangays in the first year of this research action, way back 2016. This paper measures the readiness of the target users and was very pleased that the technology self-efficacy …
					</p>
				</div>
			</div>
			@endfor
		</div>
	</div>
</div>
@endsection