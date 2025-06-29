<!DOCTYPE html>
<html lang="en">
<head>
	@include('home.css')

    <style>
        .large-input 
        {
            width: 300px;
            height: 50px; 
            font-size: 20px; 
            background-color: skyblue;
        }
        .star-rating 
        {
            direction: rtl;
            display: inline-flex;
            font-size: 2rem;
        }
        .star-rating input 
        {
            display: none;
        }
        .star-rating label 
        {
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label 
        {
        color: #f5c518;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    
    <!-- Navbar -->
    @include('home.header')

    <!--  About Section  -->
    @include('home.about')

    <!--  gallary Section  -->
   <!-- @include('home.gallery') -->

    <!-- book a table Section  -->
   @include('home.table')

    <!-- BLOG Section  -->
    @include('home.blog')

    <!-- REVIEWS Section  -->
    @include('home.review')

    <!-- CONTACT Section  -->
    @include('home.contact')

    <!-- page footer  -->
    @include('home.footer')
    <!-- end of page footer -->

	<!-- core  -->
    @include('home.js')
    
</body>
</html>
