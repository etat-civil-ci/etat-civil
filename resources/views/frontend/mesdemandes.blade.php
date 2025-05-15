@extends('layouts.app')

@section('content')

<style>
  img {
    max-width: 600px;  
    width: 200%;       
    height: auto;      
    margin-bottom: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto; 
  }
   h1 {
    text-align: center;
    margin-bottom: 0.2em;
  }
  p {
    text-align: center;
    color: #666;
    font-size: 1.2em;
  }
  main.mt-8 {
    padding: 20px;
  } 
</style>

<div class="container-fluid">
  <div class="row">
    <!-- Main Content -->
    <main class="mt-8">
      <img src="assets/images/client/maintenance.jpg" alt="Site en maintenance" />
      <!-- <h1>Page en maintenance</h1>
      <p>On bosse dur pour vous revenir vite — patience !</p> -->

	  <h1 class="mt-3 lh-base">Désolé &#9995, 
						<span class="cd-headline clip big-clip is-full-width text-primary mb-0 d-block d-xxl-inline-block">
							<span class="typed" data-type-text="Site en maintenance ."></span>&#128187
						</span>
					</h1>
    </main>
  </div>
</div>

@stop
