@extends('layouts.app')

@push('metadetails')
<title>About Us: Learn More at Reveri Jobs | Food Industry Jobs</title>
<meta name="title" content="About Us: Learn More at Reveri Jobs | Food Industry Jobs">
<meta name="description" content="Discover who we are at Reveri Jobs and what drives our passion for the food industry. Visit our about page.">
@endpush

@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('About Us')])
<!-- Inner Page Title end -->
<div class="about-wraper"> 
    <!-- About -->
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2>About Us</h2>
                <p>
                    We are a team of food & HR professionals who have come together to help our fellow food professionals & the food industry in find the right job.<br>
                    We are the only platform catering to specific food industry segments.aa
                </p>
            </div>
            <div class="col-md-5">
                <div class="postimg"><img src="images/about-us-img1.jpg" alt="your alt text" /></div>
            </div>
        </div>
    </div>

    <!-- Process -->
    <div class="what_we_do">
        <div class="container">
            <div class="main-heading">Our process is simple</div>
            <!--<div class="whatText">Diam velit voluptatibus has te. Verear aliquid mentitum nam no</div>-->
            <ul class="row whatList">
                <li class="col-md-4 col-sm-6">
                    <div class="iconWrap">
                        <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                    </div>
                    <h3>Create Account</h3>
                    <p>Create an account on Reveri Food Placements</p>
                </li>
                <li class="col-md-4 col-sm-6">
                    <div class="iconWrap">
                        <div class="icon"><i class="fa fa-file-text"></i></div>
                    </div>
                    <h3>Build CV</h3>
                    <p>Project management, Engineering & Maintenance, Marketing, Sales & Distribution</p>
                </li>
                <li class="col-md-4 col-sm-6">
                    <div class="iconWrap">
                        <div class="icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                    </div>
                    <h3>Get a Job</h3>
                    <p>Hiring & training the food professionals according to food Industry Requirements</p>
                </li>
            </ul>
        </div>
    </div>

    <!-- Text -->
    <div class="textrow">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="postimg"><img src="images/about-us-img2.jpg" alt="your alt text" /></div>
                </div>
                <div class="col-md-7">
                    <h2>Our Expertise</h2>
                    <p>
                        We at Reveri Food Jobs, are a group of food and HR consultants.
                    </p>
                    <br>
                    <p>
                        We help you find the right job & find the most suitable, candidate for your company. Reveri Jobs is the first global HR services company that specializes in recruitment for the food industry.
                    </p>
                    <br>
                    <p>
                        Having deep insight into the specific industry requirement, we ensure that the industry & candidate classification are precise & user friendly. We enable a search tool that makes it easier to find the right candidate and the right job.
                    </p>
                    <br>
                    <p>
                        We combine our passion for people in the food business and help them find the right organization, and in turn help the food Industry in finding the right candidate
                    </p>
                    <br>
                    <p>
                        Our specialization sets us apart from other competitors who have no knowledge and experience of the requirements for this industry. Our understanding of the industry helps to identify the role and requirements needed for you to be the right fit. We have developed specialized classification of the skill and talent set that helps to optimise your search.
                    </p>
                    <br>
                    <p>
                        We also have the capability to head hunt candidates from the targeted industry with specialized skill requirements.
                    </p>
                    <br>
                    <p>
                        We do not charge any fees to our candidates to sign up and join us. No employee of Reveri Food Jobs will demand for any charges from the candidates
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
