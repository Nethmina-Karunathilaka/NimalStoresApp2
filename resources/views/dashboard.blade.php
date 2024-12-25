@extends('layouts.user')
@section('content')
    <section>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="img/cover2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="img/cover3.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="img/maggeb.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section2">
        <h2 class="topic1">
            Feature Products
        </h2>
    </section>
    
    <footer>
        <div class="footer">
          <p class="email">Email: nipun.nethmina@icloud.com</p>
          <p class="address">Address: Nimal Stores, Wariyapola</p>
          <p class="about">About</p><br><br>
          <p class="copyright">© Visulio Designs</p>
        </div>
    </footer>
@endsection   
</html>