@extends('themes.ecome.layout')

@section('content')
	<section class="breadcrumb-area breadcrumb-section pt-8 pb-4">
		<div class="container">
			<h2>About Us</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
				<li class="breadcrumb-item active" aria-current="page">About</li>
			</ol>
		</div>
	</section>
    <header class="header-bg text-center">
        <h1>ABOUT MeatStore</h1>
        <p class="text-p mt-3">
            Hello Sobat MeatStore <br />
            Kami Menyediakan Pilihan Daging Yang Terjamin Kualitasnya
            <br/>
            Since 7 July 2021, Jakarta
        </p>
    </header>
@endsection