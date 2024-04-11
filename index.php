<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top transparent">
  <div class="container">
    <a class="navbar-brand" href="#"
    
    width: 300px;
    height: 160px;
>
      <img src="assets/img/mulher3.png" alt="Google Logo" width="150" height="50">
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a id="link-home" class="nav-link" href="">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#quem-somos" id="link-sobre">Sobre</a>
        </li>
        <li class="nav-item">
          <a id="link-contato" class="nav-link" href="#footer">Contato</a>
        </li>      
      </ul>
    </div>
  </div>
</nav>
<!-- Banner Section -->
<section id="banner">
  <div class="carousel slide" data-ride="carousel" id="banner-carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/img/banner1.png" class="d-block w-100" alt="Imagem 1">
        <div class="promotions">
          <button class="btn btn-warning btn-lg " id="agenda1" >Agende seu horário!</button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/banner2.png" class="d-block w-100" alt="Imagem 2">
        <div class="promotions">
            <button class="btn btn-warning btn-lg" id="agenda2">Agende seu horário!</button>
          </div>
    </div>
      <div class="carousel-item">
        <img src="https://img.freepik.com/fotos-premium/modelo-de-mulher-sorrindo-na-praia-no-banner-de-fundo_1010211-178.jpg?w=996" class="d-block w-100" alt="Imagem 3">
        <div class="promotions">
            <h1 style="font-size: 3vw;">Promoções de Verão!</h1>
            <p style="font-size: 1.5vw;">No mês das mulheres, tudo com 50% de desconto!</p>
            <button class="btn btn-success btn-lg" id="agenda3">Agende seu horário!</button>
          </div>
    </div>
    </div>
    <a class="carousel-control-prev" href="#banner-carousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#banner-carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Próximo</span>
    </a>
  </div>
</section>

<!-- Promoções Section -->
<section id="promocoes" class="mt-5 beach-section">
  <div class="container">
      <h2 class="text-center mb-5">Promoções</h2>
      <div id="carousel-promocoes" class="carousel slide" data-ride="carousel" data-interval="3000">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <!-- Primeiro grupo de promoções -->
                  <div class="row">
                      <div class="col-md-4">
                          <div class="card">
                            <img src="assets/img/praia5.jpeg" class="card-img-top" alt="Promoção 1">
                              <div class="row no-gutters">
                                  <div class="col-md-12 h-100">
                                      <div class="card-body">
                                          <h5 class="card-title">Promoção 1</h5>
                                          <p class="card-text">Descrição da Promoção 1.</p>
                                          <a href="#" class="btn btn-primary">Ver mais</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card">
                              <img src="img/promocao1.jpg" class="card-img-top" alt="Promoção 1">
                              <div class="card-body">
                                  <h5 class="card-title">Promoção 1</h5>
                                  <p class="card-text">Descrição da Promoção 1.</p>
                                  <a href="#" class="btn btn-primary">Ver mais</a>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card">
                              <img src="img/promocao1.jpg" class="card-img-top" alt="Promoção 1">
                              <div class="card-body">
                                  <h5 class="card-title">Promoção 1</h5>
                                  <p class="card-text">Descrição da Promoção 1.</p>
                                  <a href="#" class="btn btn-primary">Ver mais</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="carousel-item">
                  <!-- Segundo grupo de promoções -->
                  <div class="row">
                      <div class="col-md-4">
                          <div class="card">
                              <img src="img/promocao1.jpg" class="card-img-top" alt="Promoção 1">
                              <div class="card-body">
                                  <h5 class="card-title">Promoção 1</h5>
                                  <p class="card-text">Descrição da Promoção 1.</p>
                                  <a href="#" class="btn btn-primary">Ver mais</a>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <!-- Conteúdo do quinto card -->
                      </div>
                      <div class="col-md-4">
                          <!-- Conteúdo do sexto card -->
                      </div>
                  </div>
              </div>
              <!-- Adicione mais carousel-items conforme necessário -->
          </div>
          <!-- Controles do carrossel com classes de alinhamento e margens -->
          <a class="carousel-control-prev ml-auto" href="#carousel-promocoes" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
          </a>
          <a class="carousel-control-next mr-auto" href="#carousel-promocoes" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Próximo</span>
          </a>
      </div>
  </div>
</section>

<section id="quem-somos" class="mt-5 beach-section">
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <h2 class="section-title">Quem Somos</h2>
              <p class="section-description">Somos uma equipe dedicada a proporcionar momentos relaxantes e revigorantes sob o sol em "Sol na Laje". Nosso objetivo é oferecer uma experiência única de tomar sol em um ambiente tranquilo e acolhedor, proporcionando não apenas um bronzeado perfeito, mas também uma pausa revitalizante na rotina diária.</p>
              <p class="section-description">Com anos de experiência neste espaço ensolarado, nossa equipe está empenhada em garantir que cada momento que você passar conosco seja revigorante e gratificante. Seja relaxando sob o sol, socializando com amigos ou simplesmente apreciando a vista panorâmica do nosso terraço, estamos aqui para tornar sua experiência em "Sol na Laje" verdadeiramente especial.</p>
          </div>
          <div class="col-md-6">
              <img src="https://via.placeholder.com/400" class="img-fluid" alt="Equipe na Praia">
          </div>
      </div>
  </div>
</section>


<!-- Galeria de Fotos Section -->
<section id="galeria" class="mt-5 beach-section">
  <div class="container">
      <h2 class="section-title text-center mb-5">Nossa Galeria de Fotos</h2>
      <div id="carouselGallery" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <div class="row">
                      <div class="col-md-4 mb-4">
                              <img src="assets/img/praia1.jpeg" class="img-fluid rounded" alt="Foto 1">
                      </div>
                      <div class="col-md-4 mb-4">
                              <img src="assets/img/praia2.jpeg" class="img-fluid rounded" alt="Foto 2">
                      </div>
                      <div class="col-md-4 mb-4">
                              <img src="assets/img/praia3.jpeg" class="img-fluid rounded" alt="Foto 3">
                      </div>
                      
                      <!-- Adicione mais colunas conforme necessário para mais fotos -->
                  </div>
              </div>
              <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4 mb-4">
                            <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="Foto 1">
                    </div>
                    <div class="col-md-4 mb-4">
                            <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="Foto 2">
                    </div>
                    <div class="col-md-4 mb-4">
                            <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="Foto 3">
                    </div>
                    
                    <!-- Adicione mais colunas conforme necessário para mais fotos -->
                </div>
            </div>
              <!-- Adicione mais carousel-items conforme necessário -->
          </div>
          <a class="carousel-control-prev" href="#carouselGallery" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
          </a>
          <a class="carousel-control-next" href="#carouselGallery" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Próximo</span>
          </a>
      </div>
  </div>
</section>


<!-- Depoimentos Section -->
<section id="depoimentos" class="mt-5 beach-section">
  <div class="container">
      <h2 class="section-title text-center mb-5">Depoimentos dos Clientes</h2>
      <div id="carouselDepoimentos" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="card text-center">
                              <div class="card-body">
                                  <p class="card-text">"O serviço foi excelente! Profissionais muito dedicados e atenciosos."</p>
                                  <p class="card-text"><strong>João Silva</strong></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="carousel-item">
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="card text-center">
                              <div class="card-body">
                                  <p class="card-text">"Estou muito satisfeito com os resultados. Recomendo a todos!"</p>
                                  <p class="card-text"><strong>Maria Santos</strong></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Adicione mais carousel-items conforme necessário -->
          </div>
          <a class="carousel-control-prev" href="#carouselDepoimentos" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
          </a>
          <a class="carousel-control-next" href="#carouselDepoimentos" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Próximo</span>
          </a>
      </div>
  </div>
</section>

<!-- Footer -->
<footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-section">
          <h3>Endereço</h3>
          <p>Rua da Praia, 123</p>
          <p>Cidade Praiana</p>
          <p>CEP: 12345-678</p>
        </div>
        <div class="col-md-4 footer-section">
          <h3>Redes Sociais</h3>
          <ul>
            <li><a href="#"><i class="fab fa-facebook-f fa-lg"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram fa-lg"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter fa-lg"></i></a></li>
          </ul>
        </div>
        <div class="col-md-4 footer-section">
          <h3>Contato</h3>
          <p><i class="fas fa-phone fa-sm"></i> (123) 456-7890</p>
          <p><i class="fas fa-envelope fa-sm"></i> exemplo@email.com</p>
        </div>
      </div>
    </div>
  </footer>

<!-- Bootstrap JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script>
  // Ativa o carousel de promoções
  $('#carousel-promocoes').carousel();

  $(window).scroll(function() {
    if ($(this).scrollTop() > 50) { 
      $('.navbar').addClass('solid');
      $('.navbar').removeClass('transparent');
    } else {
      $('.navbar').removeClass('solid');
      $('.navbar').addClass('transparent');
    }
  });

  $(document).ready(function() {

    $('html, body').animate({
            scrollTop: 0
        }, 800);

    $('#link-home').click(function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });
    
    $('#link-sobre').click(function(event) {     
      event.preventDefault();
      var targetPosition = $('#quem-somos').offset().top;
      $('html, body').animate({
        scrollTop: targetPosition
      }, 800);
    });

    $('#link-contato').click(function(event) {
        event.preventDefault();
        var targetPosition = $('#footer').offset().top;
        $('html, body').animate({
            scrollTop: targetPosition
        }, 800);
    });

  });

  $("#agenda1").on("click", function(){
    window.location.href="agenda.php";
  })
  $("#agenda2").on("click", function(){
    window.location.href="agenda.php";
  })
  $("#agenda3").on("click", function(){
    window.location.href="agenda.php";
  })
</script>

</body>
</html>
